/**
 * Created by webind on 25/05/2017.
 */
avApp.filter('limit', function () {
  return function (input, count) {
    return (input !== undefined && input.split(/\s/g).length < count)
      ? input
      : input.substring(0, count * 5) + '';
  };
});

