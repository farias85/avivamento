/**
 * Created by Felipe on 16/09/2018.
 */

avApp.controller('BaseController',
  ['$scope',
    function ($scope) {

      $scope.init = () => {
      };

      $scope.initReadOnlyMap = (idMap, locations = []) => {
        // let locations = [
        //   ['Bondi Beach', -33.890542, 151.274856, 4],
        //   ['Coogee Beach', -33.923036, 151.259052, 5],
        //   ['Cronulla Beach', -34.028249, 151.157507, 3],
        //   ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
        //   ['Maroubra Beach', -33.950198, 151.259302, 1]
        //   ['Carretera del Morro', 20.010968, -75.832289, 0]
        // ];

        let latlng = new google.maps.LatLng(20.010968, -75.832289, 0);
        let center = locations.length > 0 ? new google.maps.LatLng(locations[0][1], locations[0][2]) : latlng;
        let map = new google.maps.Map(document.getElementById(idMap), {
          zoom: 15,
          center: center,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        let infowindow = new google.maps.InfoWindow();

        let marker, i;
        for (i = 0; i < locations.length; i++) {
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
          });

          google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            };
          })(marker, i));
        }
      };
    }
  ]
);