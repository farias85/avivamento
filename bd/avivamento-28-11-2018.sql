-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2018 a las 23:51:33
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `avivamento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verification_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `plain_password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `salt` longtext COLLATE utf8_unicode_ci,
  `latest_connection` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_confirm` tinyint(1) NOT NULL,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `roles_json` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `email`, `name`, `lastname`, `phone`, `verification_key`, `password`, `plain_password`, `salt`, `latest_connection`, `is_active`, `is_confirm`, `ref`, `roles_json`) VALUES
(1, 'ucifarias@gmail.com', 'Felipe', 'Rodriguez Arias', '+5358329527', '$2y$04$3vsZzUKUJs451CCYMHrqXefBGUqVi.u/pQgzQ4CjjzWlw5C2GF3Mm', '$2y$04$3vsZzUKUJs451CCYMHrqXefBGUqVi.u/pQgzQ4CjjzWlw5C2GF3Mm', 'felipefarias', '$2y$04$3vsZzUKUJs451CCYMHrqXefBGUqVi.u/pQgzQ4CjjzWlw5C2GF3Mm', NULL, 1, 1, '$2y$04$3vsZzUKUJs451CCYMHrqXefBGUqVi.u/pQgzQ4CjjzWlw5C2GF3Mm', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `ref`) VALUES
(1, '40e21b4a2c4122786937c71153633d40'),
(2, 'e0297e1d30b8d3bb19e31399721a0bfe'),
(3, '46433dad6c1e8937c834b62168b514ba'),
(4, '5ac4838a011e03e4c7c3d5c452679650'),
(5, '0cbe89c10097137cee80c9b82c5fd8eb');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_lang`
--

CREATE TABLE `categoria_lang` (
  `id` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_lang`
--

INSERT INTO `categoria_lang` (`id`, `categoria`, `lang`, `nombre`, `slug`, `descripcion`) VALUES
(1, 1, 1, 'Adoración y Alabanzas', 'adoracion-y-alabanzas', 'Adoración y Alabanzas'),
(2, 2, 1, 'Momentos Sobrenaturales y Testimonios', 'momentos-sobrenaturales-y-testimonios', 'Momentos Sobrenaturales y Testimonios'),
(3, 2, 2, 'Supernatural Moments and Testimonies', 'supernatural-moments-and-testimonies', 'Supernatural Moments and Testimonies'),
(4, 1, 2, 'Worship and Praise', 'worship-and-praise', 'Worship and Praise'),
(5, 3, 1, 'Enseñanzas', 'ensenanzas', 'Enseñanzas'),
(6, 3, 2, 'Teachings', 'teachings', 'Teachings'),
(7, 4, 1, 'Trabajo Comunitario', 'trabajo-comunitario', 'Trabajo Comunitario'),
(8, 5, 1, 'Eventos', 'eventos', 'Eventos'),
(9, 4, 2, 'Community work', 'community-work', 'Community work'),
(10, 5, 2, 'Events', 'events', 'Events');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `clave` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `valor` text COLLATE utf8_unicode_ci NOT NULL,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `requerido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `clave`, `valor`, `ref`, `requerido`) VALUES
(1, 'av_telefono', '(Cuba +53) 55960871', '5e584f35cb09d19b5fa1a4d6d610715f', 1),
(2, 'av_whatsapp', '(WhatsApp) +5355960871', '6430c4f3b6438ddb1cdb05ba24dfeb36', 1),
(3, 'av_email', 'david.arguelles2016@gmail.com', '21fbb12ac201c6ad71d36257987a61ee', 1),
(4, 'av_facebook', 'https://www.facebook.com/avivacuba.cristo', '6a70246e1f7084d766e0f7babcf37b30', 1),
(5, 'av_youtube', 'https://www.youtube.com/channel/UCPWNjgAMgihwmsyuEHtpRTw', 'ad7984cd6ed675615cb84ff0676f1f67', 1),
(6, 'av_powered_by_es', 'Desarrollado por Mision Compartida 2018', '35a5efeac70ff98874de6dd2e608ff0e', 1),
(7, 'av_direccion', 'Carretera Del Morro #309 (758,34 km) 90100 Santiago de Cuba', 'c2588de7dc1bb12a7a4d94eefee04873', 1),
(8, 'av_powered_by_en', 'Powered by Mision Compartida 2018', '1eff9ec95f693971472767c26678ecbf', 1),
(9, 'av_intro_es', 'Pequeña descripción en Español. ctetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.', 'd4d806e9171f448a6548210c4e367d82', 1),
(10, 'av_intro_en', 'In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor et totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.', '37887e8c7e5d2bf7f7037fb687372e7e', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `asunto` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `texto` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `leido` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `opts` text COLLATE utf8_unicode_ci,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id` int(11) NOT NULL,
  `media` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `para_entity_id` int(11) NOT NULL,
  `para_entity_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `options` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `when_start` datetime NOT NULL,
  `when_end` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `opts` text COLLATE utf8_unicode_ci,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `where_place` text COLLATE utf8_unicode_ci NOT NULL,
  `youtube_url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `principal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `categoria`, `created_at`, `when_start`, `when_end`, `activo`, `opts`, `ref`, `where_place`, `youtube_url`, `principal`) VALUES
(5, 1, '2018-11-18 22:30:54', '2018-11-18 00:00:00', '2018-11-18 00:00:00', 1, '', 'b71aeaee7695eab4b2ada42cf1548cae', 'asdasd', 'https://youtu.be/w6iEQB1wIKQ', 0),
(6, 3, '2018-11-18 22:38:08', '2018-11-18 00:00:00', '2018-11-18 00:00:00', 1, '', '04475271fbe6eaa35ebdd5bd1a01d715', 'asdsadas111', 'https://youtu.be/w6iEQB1wIKQ', 0),
(8, 4, '2018-11-18 23:34:04', '2018-11-18 00:00:00', '2018-11-18 00:00:00', 1, '', '81fa299cc6aeb6dd7444d7cf3acd0deb', 'asdasd', '', 0),
(9, 2, '2018-11-18 23:34:44', '2018-11-18 00:00:00', '2018-11-18 00:00:00', 1, '', '5fcb1efc16776291ea168257b0190897', 'asdasdasd', '', 0),
(10, 5, '2018-11-18 23:35:23', '2018-11-18 00:00:00', '2018-11-18 00:00:00', 1, '', 'ff876aa29f7e32a08899c38374c387c0', 'gdfgdf', 'https://youtu.be/w6iEQB1wIKQ', 0),
(11, 5, '2018-11-18 23:40:30', '2018-11-18 00:00:00', '2018-11-18 00:00:00', 1, '', '5e714e49f0f4d2d1da8fc016f222f0ff', 'hgfhjkhjkhjk', 'https://youtu.be/w6iEQB1wIKQ', 1),
(12, 1, '2018-11-19 01:27:29', '2018-11-18 00:00:00', '2018-11-18 00:00:00', 1, '', '5cb9344b2e3309e7344d137a1233e30b', 'dfgdfgdfg', 'https://youtu.be/w6iEQB1wIKQ', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_lang`
--

CREATE TABLE `evento_lang` (
  `id` int(11) NOT NULL,
  `evento` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `titulo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `subtitulo` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `texto` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `evento_lang`
--

INSERT INTO `evento_lang` (`id`, `evento`, `lang`, `titulo`, `subtitulo`, `texto`) VALUES
(2, 5, 1, 'titulo 1', 'subtitulo 1', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate deleniti ducimus earum enim error iusto, magnam molestiae natus nulla quaerat quam, quidem quisquam quos ratione vel voluptatibus voluptatum! Non, repudiandae!</p>'),
(3, 6, 1, 'titulo 2', 'subtitulo 2', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate deleniti ducimus earum enim error iusto, magnam molestiae natus nulla quaerat quam, quidem quisquam quos ratione vel voluptatibus voluptatum! Non, repudiandae!</p>'),
(4, 6, 2, 'Title Two', 'Subtitle Two', '<p>English Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab assumenda consequatur dolor dolorum eaque facere fugiat ipsa ipsum iste, mollitia perferendis perspiciatis praesentium quas, quasi quidem sint tempore veritatis voluptatum?</p>'),
(6, 8, 1, 'asdasd', 'asdasdas', '<p>asdasdasd</p>'),
(7, 9, 1, 'saasdasd', 'asdasdasdasdasd', '<p>asasdasddasdd</p>'),
(8, 10, 1, 'asdasd', 'asdasdasd', '<p>dfgdfg</p>'),
(9, 11, 1, 'trhghgh', 'gh', '<p>gfhgfgf</p>'),
(10, 12, 1, 'dsffsd', 'fsdfsdgfd', '<p>gdfgdfg<br></p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `faq`
--

INSERT INTO `faq` (`id`, `ref`, `activo`) VALUES
(1, '56277e6328cc5604514569da73e48aab', 1),
(3, '7a73265eb2dde1b9e7bcd6596c8980f1', 0),
(4, '8dd262373292879816299ce386e3b2d4', 0),
(5, 'b5447f6b585045faca905e9fe1622fe7', 1),
(6, '1eb1c6454558102d85593d28c3b9eac5', 0),
(7, 'a5e35fc758b24052be31623d4f28f877', 1),
(8, '5010e1685eb54b9966ce89b26e579df7', 1),
(9, 'f5fe89f78f1fd8ca25b829f5252c522f', 1),
(10, '7be024e13cea81cf8824850788483fd5', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faq_lang`
--

CREATE TABLE `faq_lang` (
  `id` int(11) NOT NULL,
  `faq` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `pregunta` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `respuesta` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `faq_lang`
--

INSERT INTO `faq_lang` (`id`, `faq`, `lang`, `pregunta`, `respuesta`) VALUES
(1, 1, 1, 'Esta es una pregunta', 'esta es la respuesta'),
(3, 3, 1, 'Non consectetur a erat nam at lectus urna duis?', '<p><b>Feugiat pretium </b><br></p><p><u>nibh ipsum consequat.</u> <br></p><ol><li>Tempus iaculis urna id volutpat lacus l</li><li>aoreet non curabitur g</li><li>ravida. Venenatis lectus</li><li>&nbsp;magna fringilla urna por</li><li>ttitor rhoncus dolor purus non.</li></ol>'),
(4, 4, 1, 'Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?', 'Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.'),
(5, 5, 1, 'Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?', 'Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis'),
(6, 6, 1, 'Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?', 'Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.'),
(7, 1, 2, 'This is the question', 'That is my answer'),
(8, 7, 1, '¿Cuál es nuestra visión?', '<div>La visión de nuestra casa apostólica es alcanzar y sostener un avivamiento bajo 4 etapas de la visión: <br></div><div><p><br></p></div><ul><li>Ganar almas a través de la Gran Comisión de manera sobrenatural</li><li>Discipular correctamente</li><li>Ministrarles una liberación completa y de manera sobrenatural</li><li>Entrenar, equipar y enviar</li></ul><div><p><br></p></div><div>\r\n\r\nEntrenamos a las personas a hacer lo mismo que ellos ven en el padre de la casa, luego de darles diferentes niveles de equipamiento sobrenatural y discipulado los entrenamos en células que funcionan de manera sobrenatural, hasta ungirlos como Pastor oficial y enviarlos a otros pueblos, teniendo como base el fundamento de los Apóstoles y los Profetas (Efesios 2:20 y 3:10), recibiendo éstos constantemente mentoreos y visitas del Apóstol o el supervisor.\r\n\r\nNuestra visión se mantiene en la sana doctrina y en el fundamento apostólico y profético siendo la principal piedra del ángulo Jesucristo mismo.\r\n\r\nTenemos como requisito en las células y las iglesias: <br></div><div><p><br></p></div><ul><li>Amar como Cristo amó la visión del Padre</li><li>Mantener las células dando fruto</li><li>Reunirse 2 veces por semana</li><li>Prepararlos para enviarlos también</li><li>Trabajar con las familias</li><li>Velar por la santidad de los miembros de la célula</li><li>No permitir murmuración y chisme</li><li>No edificar en fundamento ajeno</li><li>Mantener la visión sin desviarse</li></ul>'),
(9, 7, 2, 'What is our vision?', 'The vision of our apostolic house is to reach and sustain a revival under 4 stages of vision:\r\n\r\n<ul><li>Winning souls through the Great Commission in a supernatural way</li><li>Disciple correctly</li><li>To minister to them a complete and supernatural release</li><li>Train, equip and send</li></ul><div><p><br></p></div>\r\n\r\nWe train people to do the same thing that they see in the father of the house, after giving them different levels of supernatural equipment and discipleship, we train them in cells that work in a supernatural way, until they are anointed as official Pastor and send them to other towns, taking as base the foundation of the Apostles and the Prophets (Ephesians 2:20 and 3:10), receiving these constantly mentoring and visits from the Apostle or the supervisor. Our vision remains in the sound doctrine and in the apostolic and prophetic foundation being the main corner stone Jesus Christ himself. We have as a requirement in cells and churches:\r\n\r\n<br><br><ul><li>Love as Christ loved the Father\'s vision</li><li>Keep the cells bearing fruit</li><li>Meet twice a week</li><li>Prepare them to send them too</li><li>Work with families</li><li>Ensure the sanctity of the members of the cell</li><li>Do not allow gossip and gossip</li><li>Do not build on someone else\'s foundation</li><li>Keep the vision without deviating</li></ul>'),
(10, 8, 1, '¿Quieres conocer los propósitos de nuestra ministerio?', '<ul><li>Ganar las almas</li><li>Mantener el Avivamiento</li><li>Guerra espiritual</li><li>Confrontar el espíritu de religión</li><li>Demostración del poder y Espíritu Santo</li><li>Plantadores de iglesias</li><li>Multiplicación</li><li>Conquista de los siete montes (Apocalipsís 5:12)</li></ul>'),
(11, 8, 2, 'Do you want to know the purposes of our ministry?', '<ul><li>Win the souls</li><li>Keep the Revival</li><li>Spiritual war</li><li>Confront the spirit of religion</li><li>Demonstration of power and Holy Spirit</li><li>Church Planters</li><li>Multiplication</li><li>Conquest of the seven mountains (Revelation 5:12)</li></ul>'),
(12, 9, 1, '¿Cuál es nuestro enfoque de trabajo?', '<ul><li>Paternidad (darle sentido profético y de pertenencia a los hijos, provisión, protección y herencia)</li><li>Adoración profunda</li><li>Comunión</li><li>Edificación personal y colectiva de los creyentes por medio de la activación de los dones espirituales, naturales y ministeriales</li><li>Por un espíritu de oración y guerra</li><li>Verdaderos hijos con el ADN espiritual de la casa</li><li>Orden (respeto a la autoridad y al gobierno establecido por Dios en la casa) (1 Cor 14:40)</li><li>Discipulado (la Iglesia sea una fábrica de discípulos y NO un almacén de creyentes)</li><li>Visión (es el enfoque a la multiplicación, liberación y avivamiento), reconociendo en verdadero valor de las almas, es dirección y guianza de Dios y el Espíritu Santo al propósito de Dios</li><li>Revelación (es la activación fresca de la Palabra de Dios sobre los creyentes en forma de rema, activando, cambiando y transformando en experiencias legítimas cada día a los creyentes, es despertar lo que está dormido y soltar lo que está estancado)</li><li>Evangelismo (reconocer el valor de las almas y tener pasión por ellas y traer los hijos a casa)</li><li>El valor de la honra (Nos lleva a tomar lo que hay dentro de nuestros padres espirituales, debemos apoyar financieramente y en todas formas a nuestros padres espirituales y obedecerlos, esto desata herencia)</li></ul>'),
(13, 9, 2, 'What is our approach to work?', '<ul><li>Paternity (giving prophetic meaning and belonging to children, provision, protection and inheritance)</li><li>Deep worship</li><li>Communion</li><li>Personal and collective building of believers through the activation of spiritual, natural and ministerial gifts</li><li>For a spirit of prayer and war</li><li>True children with the spiritual DNA of the house</li><li>Order (respect for the authority and government established by God in the house) (1 Cor 14:40)</li><li>Discipleship (the Church is a factory of disciples and NOT a store of believers)</li><li>Vision (is the approach to multiplication, liberation and revival), recognizing the true value of souls, is the direction and guidance of God and the Holy Spirit to the purpose of God</li><li>Revelation (is the fresh activation of the Word of God on believers in the form of rows, activating, changing and transforming believers into legitimate experiences every day, is to awaken what is asleep and let go of what is stagnant)</li><li>Evangelism (recognize the value of souls and have a passion for them and bring their children home)</li><li>The value of honor (It leads us to take what is inside our spiritual parents, we must support our spiritual parents financially and in all ways and obey them, this unleashes inheritance)</li></ul>'),
(14, 10, 1, '¿Quieres saber de nuestras asociaciones y cobertura?', '<p align=\"justify\">Estamos abiertos a cualquiera que desee asociarse a nuestro Ministerio con la condición de Amor, Fidelidad y Lealtad. También tenemos la mayor disposición de recibir seminarios que tengan como base el bienestar de las familias y el fundamento apostólico y profético. <br></p><p align=\"justify\">Si esta interesado en trabajar con nosotros podrá localizarnos en los teléfonos siguientes desde Cuba: <b>+22690360 o +52550234.</b></p>'),
(15, 10, 2, 'Do you want to know about our associations and coverage?', '<p>We are open to anyone wishing to join our Ministry with the condition of Love, Loyalty and Loyalty. We are also more willing to receive seminars based on the well-being of families and the apostolic and prophetic foundation.</p><p>If you are interested in working with us can contact us on the following numbers from Cuba: <b>+22690360 or +52550234.</b></p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gallery_item`
--

CREATE TABLE `gallery_item` (
  `id` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `gallery_item`
--

INSERT INTO `gallery_item` (`id`, `activo`, `ref`) VALUES
(5, 1, 'f7e06cf2ba9d22a7b87db1b3c199c9ca'),
(6, 1, 'ca1f120a840e80b0599a58427d7fe988'),
(7, 1, '260463fa4378d959640910372257299a'),
(8, 1, 'fdd25cb2a8f99f872bb0e9f8a8b82ad7'),
(9, 1, '798983b136137131ab326cabff165c4c'),
(10, 1, '26025db2ea1e03fd213726c02dc9ab0b'),
(11, 1, '3af4f6933c6fcc63597374e088edfbf2'),
(12, 1, 'ffb552a2ae6cf1580a8b63f597bbb0e6'),
(13, 1, '70473be35326fed423ecd6fa470f91ff'),
(14, 1, 'f73c3dda64db21811836f1f68c82619c'),
(15, 1, 'd70c79e6d60642df76f7ca757bd45110');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `iso_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `language_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `default_lang` tinyint(1) NOT NULL,
  `date_format_lite` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_format_full` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `lang`
--

INSERT INTO `lang` (`id`, `nombre`, `iso_code`, `language_code`, `activo`, `default_lang`, `date_format_lite`, `date_format_full`) VALUES
(1, 'Español', 'es', 'ES_es', 1, 1, NULL, NULL),
(2, 'English', 'en', 'EN_us', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `tipo_media` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `entity_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `entity_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`id`, `tipo_media`, `name`, `alt`, `path`, `updated_at`, `created_at`, `entity_id`, `entity_name`, `is_active`) VALUES
(1, 1, 'd9f49e8a18af2cd373d2ececb117a4e1.jpeg', '1.jpg', 'd9f49e8a18af2cd373d2ececb117a4e1.jpeg', '2018-11-14 23:15:18', '2018-11-14 23:15:18', '5', 'CommonBundle:GalleryItem', 1),
(2, 1, '101c5a01ed6097744a5d03f12a5f2414.jpeg', '2.jpg', '101c5a01ed6097744a5d03f12a5f2414.jpeg', '2018-11-14 23:15:29', '2018-11-14 23:15:29', '6', 'CommonBundle:GalleryItem', 1),
(3, 1, '1ec8b3979776c74c3a7c8bfe74e3a890.jpeg', '3.jpg', '1ec8b3979776c74c3a7c8bfe74e3a890.jpeg', '2018-11-14 23:15:39', '2018-11-14 23:15:39', '7', 'CommonBundle:GalleryItem', 1),
(4, 1, 'be60caa4180b64c8f70ffe7eb312daf3.jpeg', '4.jpg', 'be60caa4180b64c8f70ffe7eb312daf3.jpeg', '2018-11-14 23:15:49', '2018-11-14 23:15:49', '8', 'CommonBundle:GalleryItem', 1),
(5, 1, '70660fdc848bf596f62f7f8c7fb77898.jpeg', '5.jpg', '70660fdc848bf596f62f7f8c7fb77898.jpeg', '2018-11-14 23:15:59', '2018-11-14 23:15:59', '9', 'CommonBundle:GalleryItem', 1),
(6, 1, '245ae7ea0507e7fdbb27947fd30c6968.jpeg', '6.jpg', '245ae7ea0507e7fdbb27947fd30c6968.jpeg', '2018-11-14 23:16:09', '2018-11-14 23:16:09', '10', 'CommonBundle:GalleryItem', 1),
(7, 1, '64dae9430690517a915929ee5f0ec491.jpeg', '7.jpg', '64dae9430690517a915929ee5f0ec491.jpeg', '2018-11-14 23:16:18', '2018-11-14 23:16:18', '11', 'CommonBundle:GalleryItem', 1),
(8, 1, '08efddd9e5c51423254c28dc871669cf.jpeg', '8.jpg', '08efddd9e5c51423254c28dc871669cf.jpeg', '2018-11-14 23:16:28', '2018-11-14 23:16:28', '12', 'CommonBundle:GalleryItem', 1),
(9, 1, '021fdbf23d3cfd05f526bdbd212dd30c.jpeg', '8.1.jpg', '021fdbf23d3cfd05f526bdbd212dd30c.jpeg', '2018-11-14 23:16:38', '2018-11-14 23:16:38', '13', 'CommonBundle:GalleryItem', 1),
(10, 1, '2eca228b223da81e7b143bc35d0b485b.jpeg', '20180815_195826.jpg', '2eca228b223da81e7b143bc35d0b485b.jpeg', '2018-11-14 23:16:53', '2018-11-14 23:16:53', '14', 'CommonBundle:GalleryItem', 1),
(11, 1, '001a6fb03f09e5fbec6933de5ebc0f89.jpeg', '10065240.jpg', '001a6fb03f09e5fbec6933de5ebc0f89.jpeg', '2018-11-14 23:17:03', '2018-11-14 23:17:03', '15', 'CommonBundle:GalleryItem', 1),
(12, 1, '91515401b6db1a250c66d45c290d98a4.jpeg', '20180822_142042.jpg', '91515401b6db1a250c66d45c290d98a4.jpeg', '2018-11-18 22:30:54', '2018-11-18 22:30:54', '5', 'CommonBundle:Evento', 1),
(13, 1, '78662c6db38ff28e3ae99b4725febf98.jpeg', '20180820_162454.jpg', '78662c6db38ff28e3ae99b4725febf98.jpeg', '2018-11-18 22:38:08', '2018-11-18 22:38:08', '6', 'CommonBundle:Evento', 1),
(14, 2, 'dasdasdassssss', 'dasdasdassssss', 'dasdasdassssss', '2018-11-18 22:38:08', '2018-11-18 22:38:08', '6', 'CommonBundle:Evento', 1),
(16, 1, '742d02ab4d580f9f35b70970ccd56806.jpeg', '20180819_182125.jpg', '742d02ab4d580f9f35b70970ccd56806.jpeg', '2018-11-18 23:34:04', '2018-11-18 23:34:04', '8', 'CommonBundle:Evento', 1),
(17, 1, '6dbebd7fb685cc39151a7fcfc9975a80.jpeg', '20180819_181752.jpg', '6dbebd7fb685cc39151a7fcfc9975a80.jpeg', '2018-11-18 23:34:44', '2018-11-18 23:34:44', '9', 'CommonBundle:Evento', 1),
(18, 1, '58e97868bd425f4f622ccc10519b7977.jpeg', '20180819_181747.jpg', '58e97868bd425f4f622ccc10519b7977.jpeg', '2018-11-18 23:35:23', '2018-11-18 23:35:23', '10', 'CommonBundle:Evento', 1),
(19, 1, '03c22be9b026d9a3ca14f19fc59730f1.jpeg', '20180819_181701.jpg', '03c22be9b026d9a3ca14f19fc59730f1.jpeg', '2018-11-18 23:40:30', '2018-11-18 23:40:30', '11', 'CommonBundle:Evento', 1),
(20, 1, 'fe4f51d02c1e92e0b0ed031a90d33850.jpeg', '20180815_195839.jpg', 'fe4f51d02c1e92e0b0ed031a90d33850.jpeg', '2018-11-19 01:27:29', '2018-11-19 01:27:29', '12', 'CommonBundle:Evento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `confirm_at` datetime DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `is_confirm` tinyint(1) NOT NULL,
  `opts` text COLLATE utf8_unicode_ci NOT NULL,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `newsletter`
--

INSERT INTO `newsletter` (`id`, `created_at`, `confirm_at`, `email`, `is_confirm`, `opts`, `ref`) VALUES
(1, '2018-11-15 03:54:03', NULL, 'ciberner@yahoo.es', 0, '', 'ad147f0918672533d477d800af5b1d7c');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_media`
--

CREATE TABLE `tipo_media` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_media`
--

INSERT INTO `tipo_media` (`id`, `nombre`, `slug`, `descripcion`) VALUES
(1, 'imagen', 'imagen', 'imagen'),
(2, 'youtube-url', 'youtube-url', 'youtube-url'),
(3, 'galeria-evento', 'galeria-evento', 'galeria-evento'),
(4, 'galeria-frontend', 'galeria-frontend', 'galeria-frontend');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_lang`
--
ALTER TABLE `categoria_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DDB141234E10122D` (`categoria`),
  ADD KEY `IDX_DDB1412331098462` (`lang`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6B12EC76A2CA10C` (`media`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_47860B054E10122D` (`categoria`);

--
-- Indices de la tabla `evento_lang`
--
ALTER TABLE `evento_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_294D42F847860B05` (`evento`),
  ADD KEY `IDX_294D42F831098462` (`lang`);

--
-- Indices de la tabla `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `faq_lang`
--
ALTER TABLE `faq_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3417EC04E8FF75CC` (`faq`),
  ADD KEY `IDX_3417EC0431098462` (`lang`);

--
-- Indices de la tabla `gallery_item`
--
ALTER TABLE `gallery_item`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6A2CA10C6C903BC4` (`tipo_media`);

--
-- Indices de la tabla `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_media`
--
ALTER TABLE `tipo_media`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `categoria_lang`
--
ALTER TABLE `categoria_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `evento_lang`
--
ALTER TABLE `evento_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `faq_lang`
--
ALTER TABLE `faq_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `gallery_item`
--
ALTER TABLE `gallery_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipo_media`
--
ALTER TABLE `tipo_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria_lang`
--
ALTER TABLE `categoria_lang`
  ADD CONSTRAINT `FK_DDB1412331098462` FOREIGN KEY (`lang`) REFERENCES `lang` (`id`),
  ADD CONSTRAINT `FK_DDB141234E10122D` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `FK_B6B12EC76A2CA10C` FOREIGN KEY (`media`) REFERENCES `media` (`id`);

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `FK_47860B054E10122D` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `evento_lang`
--
ALTER TABLE `evento_lang`
  ADD CONSTRAINT `FK_294D42F831098462` FOREIGN KEY (`lang`) REFERENCES `lang` (`id`),
  ADD CONSTRAINT `FK_294D42F847860B05` FOREIGN KEY (`evento`) REFERENCES `evento` (`id`);

--
-- Filtros para la tabla `faq_lang`
--
ALTER TABLE `faq_lang`
  ADD CONSTRAINT `FK_3417EC0431098462` FOREIGN KEY (`lang`) REFERENCES `lang` (`id`),
  ADD CONSTRAINT `FK_3417EC04E8FF75CC` FOREIGN KEY (`faq`) REFERENCES `faq` (`id`);

--
-- Filtros para la tabla `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_6A2CA10C6C903BC4` FOREIGN KEY (`tipo_media`) REFERENCES `tipo_media` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
