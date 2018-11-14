# SQL Manager 2007 for MySQL 4.1.2.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : avivamento


#
# Structure for the `administrador` table :
#

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `roles_json` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `categoria` table :
#

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `lang` table :
#

CREATE TABLE `lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `iso_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `language_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `default_lang` tinyint(1) NOT NULL,
  `date_format_lite` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_format_full` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `categoria_lang` table :
#

CREATE TABLE `categoria_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_DDB141234E10122D` (`categoria`),
  KEY `IDX_DDB1412331098462` (`lang`),
  CONSTRAINT `FK_DDB1412331098462` FOREIGN KEY (`lang`) REFERENCES `lang` (`id`),
  CONSTRAINT `FK_DDB141234E10122D` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `configuracion` table :
#

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `valor` text COLLATE utf8_unicode_ci NOT NULL,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `requerido` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `contacto` table :
#

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `texto` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `leido` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `opts` text COLLATE utf8_unicode_ci,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `tipo_media` table :
#

CREATE TABLE `tipo_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `media` table :
#

CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_media` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `entity_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `entity_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6A2CA10C6C903BC4` (`tipo_media`),
  CONSTRAINT `FK_6A2CA10C6C903BC4` FOREIGN KEY (`tipo_media`) REFERENCES `tipo_media` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `documento` table :
#

CREATE TABLE `documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `para_entity_id` int(11) NOT NULL,
  `para_entity_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `options` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6B12EC76A2CA10C` (`media`),
  CONSTRAINT `FK_B6B12EC76A2CA10C` FOREIGN KEY (`media`) REFERENCES `media` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `evento` table :
#

CREATE TABLE `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `when` datetime NOT NULL,
  `where` text COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `opts` text COLLATE utf8_unicode_ci,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_47860B054E10122D` (`categoria`),
  CONSTRAINT `FK_47860B054E10122D` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `evento_lang` table :
#

CREATE TABLE `evento_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evento` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `titulo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `subtitulo` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `texto` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_294D42F847860B05` (`evento`),
  KEY `IDX_294D42F831098462` (`lang`),
  CONSTRAINT `FK_294D42F831098462` FOREIGN KEY (`lang`) REFERENCES `lang` (`id`),
  CONSTRAINT `FK_294D42F847860B05` FOREIGN KEY (`evento`) REFERENCES `evento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `faq` table :
#

CREATE TABLE `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `faq_lang` table :
#

CREATE TABLE `faq_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faq` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `pregunta` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `respuesta` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3417EC04E8FF75CC` (`faq`),
  KEY `IDX_3417EC0431098462` (`lang`),
  CONSTRAINT `FK_3417EC0431098462` FOREIGN KEY (`lang`) REFERENCES `lang` (`id`),
  CONSTRAINT `FK_3417EC04E8FF75CC` FOREIGN KEY (`faq`) REFERENCES `faq` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `newsletter` table :
#

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `confirm_at` datetime DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `is_confirm` tinyint(1) NOT NULL,
  `opts` text COLLATE utf8_unicode_ci NOT NULL,
  `ref` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for the `administrador` table  (LIMIT 0,500)
#

INSERT INTO `administrador` (`id`, `email`, `name`, `lastname`, `phone`, `verification_key`, `password`, `plain_password`, `salt`, `latest_connection`, `is_active`, `is_confirm`, `ref`, `roles_json`) VALUES
  (1,'ucifarias@gmail.com','Felipe','Rodriguez Arias','+5358329527','$2y$04$3vsZzUKUJs451CCYMHrqXefBGUqVi.u/pQgzQ4CjjzWlw5C2GF3Mm','$2y$04$3vsZzUKUJs451CCYMHrqXefBGUqVi.u/pQgzQ4CjjzWlw5C2GF3Mm','felipefarias','$2y$04$3vsZzUKUJs451CCYMHrqXefBGUqVi.u/pQgzQ4CjjzWlw5C2GF3Mm',NULL,1,1,'$2y$04$3vsZzUKUJs451CCYMHrqXefBGUqVi.u/pQgzQ4CjjzWlw5C2GF3Mm',NULL);

COMMIT;

#
# Data for the `categoria` table  (LIMIT 0,500)
#

INSERT INTO `categoria` (`id`, `ref`) VALUES
  (1,'40e21b4a2c4122786937c71153633d40'),
  (2,'e0297e1d30b8d3bb19e31399721a0bfe'),
  (3,'46433dad6c1e8937c834b62168b514ba'),
  (4,'5ac4838a011e03e4c7c3d5c452679650'),
  (5,'0cbe89c10097137cee80c9b82c5fd8eb');

COMMIT;

#
# Data for the `lang` table  (LIMIT 0,500)
#

INSERT INTO `lang` (`id`, `nombre`, `iso_code`, `language_code`, `activo`, `default_lang`, `date_format_lite`, `date_format_full`) VALUES
  (1,'Español','es','ES_es',1,1,NULL,NULL),
  (2,'English','en','EN_us',1,0,NULL,NULL);

COMMIT;

#
# Data for the `categoria_lang` table  (LIMIT 0,500)
#

INSERT INTO `categoria_lang` (`id`, `categoria`, `lang`, `nombre`, `slug`, `descripcion`) VALUES
  (1,1,1,'Adoración y Alabanzas','adoracion-y-alabanzas','Adoración y Alabanzas'),
  (2,2,1,'Momentos Sobrenaturales y Testimonios','momentos-sobrenaturales-y-testimonios','Momentos Sobrenaturales y Testimonios'),
  (3,2,2,'Supernatural Moments and Testimonies','supernatural-moments-and-testimonies','Supernatural Moments and Testimonies'),
  (4,1,2,'Worship and Praise','worship-and-praise','Worship and Praise'),
  (5,3,1,'Enseñanzas','ensenanzas','Enseñanzas'),
  (6,3,2,'Teachings','teachings','Teachings'),
  (7,4,1,'Trabajo Comunitario','trabajo-comunitario','Trabajo Comunitario'),
  (8,5,1,'Eventos','eventos','Eventos'),
  (9,4,2,'Community work','community-work','Community work'),
  (10,5,2,'Events','events','Events');

COMMIT;

#
# Data for the `configuracion` table  (LIMIT 0,500)
#

INSERT INTO `configuracion` (`id`, `clave`, `valor`, `ref`, `requerido`) VALUES
  (1,'av_telefono','(Cuba +53) 55960871','5e584f35cb09d19b5fa1a4d6d610715f',1),
  (2,'av_whatsapp','(WhatsApp) +5355960871','6430c4f3b6438ddb1cdb05ba24dfeb36',1),
  (3,'av_email','david.arguelles2016@gmail.com','21fbb12ac201c6ad71d36257987a61ee',1),
  (4,'av_facebook','https://www.facebook.com/avivacuba.cristo','6a70246e1f7084d766e0f7babcf37b30',1),
  (5,'av_youtube','https://www.youtube.com/channel/UCPWNjgAMgihwmsyuEHtpRTw','ad7984cd6ed675615cb84ff0676f1f67',1),
  (6,'av_powered_by_es','Desarrollado por Mision Compartida 2018','35a5efeac70ff98874de6dd2e608ff0e',1),
  (7,'av_direccion','Carretera Del Morro #309 (758,34 km) 90100 Santiago de Cuba','c2588de7dc1bb12a7a4d94eefee04873',1),
  (8,'av_powered_by_en','Powered by Mision Compartida 2018','1eff9ec95f693971472767c26678ecbf',1),
  (9,'av_intro_es','Pequeña descripción en Español. ctetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.','d4d806e9171f448a6548210c4e367d82',1),
  (10,'av_intro_en','In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor et totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.','37887e8c7e5d2bf7f7037fb687372e7e',1);

COMMIT;

#
# Data for the `tipo_media` table  (LIMIT 0,500)
#

INSERT INTO `tipo_media` (`id`, `nombre`, `slug`, `descripcion`) VALUES
  (1,'imagen','imagen','imagen');

COMMIT;

#
# Data for the `faq` table  (LIMIT 0,500)
#

INSERT INTO `faq` (`id`, `ref`, `activo`) VALUES
  (1,'56277e6328cc5604514569da73e48aab',1),
  (3,'7a73265eb2dde1b9e7bcd6596c8980f1',0),
  (4,'8dd262373292879816299ce386e3b2d4',0),
  (5,'b5447f6b585045faca905e9fe1622fe7',1),
  (6,'1eb1c6454558102d85593d28c3b9eac5',0),
  (7,'a5e35fc758b24052be31623d4f28f877',1),
  (8,'5010e1685eb54b9966ce89b26e579df7',1),
  (9,'f5fe89f78f1fd8ca25b829f5252c522f',1),
  (10,'7be024e13cea81cf8824850788483fd5',1);

COMMIT;

#
# Data for the `faq_lang` table  (LIMIT 0,500)
#

INSERT INTO `faq_lang` (`id`, `faq`, `lang`, `pregunta`, `respuesta`) VALUES
  (1,1,1,'Esta es una pregunta','esta es la respuesta'),
  (3,3,1,'Non consectetur a erat nam at lectus urna duis?','<p><b>Feugiat pretium </b><br></p><p><u>nibh ipsum consequat.</u> <br></p><ol><li>Tempus iaculis urna id volutpat lacus l</li><li>aoreet non curabitur g</li><li>ravida. Venenatis lectus</li><li>&nbsp;magna fringilla urna por</li><li>ttitor rhoncus dolor purus non.</li></ol>'),
  (4,4,1,'Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?','Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.'),
  (5,5,1,'Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?','Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis'),
  (6,6,1,'Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?','Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.'),
  (7,1,2,'This is the question','That is my answer'),
  (8,7,1,'¿Cuál es nuestra visión?','<div>La visión de nuestra casa apostólica es alcanzar y sostener un avivamiento bajo 4 etapas de la visión: <br></div><div><p><br></p></div><ul><li>Ganar almas a través de la Gran Comisión de manera sobrenatural</li><li>Discipular correctamente</li><li>Ministrarles una liberación completa y de manera sobrenatural</li><li>Entrenar, equipar y enviar</li></ul><div><p><br></p></div><div>\r\n\r\nEntrenamos a las personas a hacer lo mismo que ellos ven en el padre de la casa, luego de darles diferentes niveles de equipamiento sobrenatural y discipulado los entrenamos en células que funcionan de manera sobrenatural, hasta ungirlos como Pastor oficial y enviarlos a otros pueblos, teniendo como base el fundamento de los Apóstoles y los Profetas (Efesios 2:20 y 3:10), recibiendo éstos constantemente mentoreos y visitas del Apóstol o el supervisor.\r\n\r\nNuestra visión se mantiene en la sana doctrina y en el fundamento apostólico y profético siendo la principal piedra del ángulo Jesucristo mismo.\r\n\r\nTenemos como requisito en las células y las iglesias: <br></div><div><p><br></p></div><ul><li>Amar como Cristo amó la visión del Padre</li><li>Mantener las células dando fruto</li><li>Reunirse 2 veces por semana</li><li>Prepararlos para enviarlos también</li><li>Trabajar con las familias</li><li>Velar por la santidad de los miembros de la célula</li><li>No permitir murmuración y chisme</li><li>No edificar en fundamento ajeno</li><li>Mantener la visión sin desviarse</li></ul>'),
  (9,7,2,'What is our vision?','The vision of our apostolic house is to reach and sustain a revival under 4 stages of vision:\r\n\r\n<ul><li>Winning souls through the Great Commission in a supernatural way</li><li>Disciple correctly</li><li>To minister to them a complete and supernatural release</li><li>Train, equip and send</li></ul><div><p><br></p></div>\r\n\r\nWe train people to do the same thing that they see in the father of the house, after giving them different levels of supernatural equipment and discipleship, we train them in cells that work in a supernatural way, until they are anointed as official Pastor and send them to other towns, taking as base the foundation of the Apostles and the Prophets (Ephesians 2:20 and 3:10), receiving these constantly mentoring and visits from the Apostle or the supervisor. Our vision remains in the sound doctrine and in the apostolic and prophetic foundation being the main corner stone Jesus Christ himself. We have as a requirement in cells and churches:\r\n\r\n<br><br><ul><li>Love as Christ loved the Father''s vision</li><li>Keep the cells bearing fruit</li><li>Meet twice a week</li><li>Prepare them to send them too</li><li>Work with families</li><li>Ensure the sanctity of the members of the cell</li><li>Do not allow gossip and gossip</li><li>Do not build on someone else''s foundation</li><li>Keep the vision without deviating</li></ul>'),
  (10,8,1,'¿Quieres conocer los propósitos de nuestra ministerio?','<ul><li>Ganar las almas</li><li>Mantener el Avivamiento</li><li>Guerra espiritual</li><li>Confrontar el espíritu de religión</li><li>Demostración del poder y Espíritu Santo</li><li>Plantadores de iglesias</li><li>Multiplicación</li><li>Conquista de los siete montes (Apocalipsís 5:12)</li></ul>'),
  (11,8,2,'Do you want to know the purposes of our ministry?','<ul><li>Win the souls</li><li>Keep the Revival</li><li>Spiritual war</li><li>Confront the spirit of religion</li><li>Demonstration of power and Holy Spirit</li><li>Church Planters</li><li>Multiplication</li><li>Conquest of the seven mountains (Revelation 5:12)</li></ul>'),
  (12,9,1,'¿Cuál es nuestro enfoque de trabajo?','<ul><li>Paternidad (darle sentido profético y de pertenencia a los hijos, provisión, protección y herencia)</li><li>Adoración profunda</li><li>Comunión</li><li>Edificación personal y colectiva de los creyentes por medio de la activación de los dones espirituales, naturales y ministeriales</li><li>Por un espíritu de oración y guerra</li><li>Verdaderos hijos con el ADN espiritual de la casa</li><li>Orden (respeto a la autoridad y al gobierno establecido por Dios en la casa) (1 Cor 14:40)</li><li>Discipulado (la Iglesia sea una fábrica de discípulos y NO un almacén de creyentes)</li><li>Visión (es el enfoque a la multiplicación, liberación y avivamiento), reconociendo en verdadero valor de las almas, es dirección y guianza de Dios y el Espíritu Santo al propósito de Dios</li><li>Revelación (es la activación fresca de la Palabra de Dios sobre los creyentes en forma de rema, activando, cambiando y transformando en experiencias legítimas cada día a los creyentes, es despertar lo que está dormido y soltar lo que está estancado)</li><li>Evangelismo (reconocer el valor de las almas y tener pasión por ellas y traer los hijos a casa)</li><li>El valor de la honra (Nos lleva a tomar lo que hay dentro de nuestros padres espirituales, debemos apoyar financieramente y en todas formas a nuestros padres espirituales y obedecerlos, esto desata herencia)</li></ul>'),
  (13,9,2,'What is our approach to work?','<ul><li>Paternity (giving prophetic meaning and belonging to children, provision, protection and inheritance)</li><li>Deep worship</li><li>Communion</li><li>Personal and collective building of believers through the activation of spiritual, natural and ministerial gifts</li><li>For a spirit of prayer and war</li><li>True children with the spiritual DNA of the house</li><li>Order (respect for the authority and government established by God in the house) (1 Cor 14:40)</li><li>Discipleship (the Church is a factory of disciples and NOT a store of believers)</li><li>Vision (is the approach to multiplication, liberation and revival), recognizing the true value of souls, is the direction and guidance of God and the Holy Spirit to the purpose of God</li><li>Revelation (is the fresh activation of the Word of God on believers in the form of rows, activating, changing and transforming believers into legitimate experiences every day, is to awaken what is asleep and let go of what is stagnant)</li><li>Evangelism (recognize the value of souls and have a passion for them and bring their children home)</li><li>The value of honor (It leads us to take what is inside our spiritual parents, we must support our spiritual parents financially and in all ways and obey them, this unleashes inheritance)</li></ul>'),
  (14,10,1,'¿Quieres saber de nuestras asociaciones y cobertura?','<p align=\"justify\">Estamos abiertos a cualquiera que desee asociarse a nuestro Ministerio con la condición de Amor, Fidelidad y Lealtad. También tenemos la mayor disposición de recibir seminarios que tengan como base el bienestar de las familias y el fundamento apostólico y profético. <br></p><p align=\"justify\">Si esta interesado en trabajar con nosotros podrá localizarnos en los teléfonos siguientes desde Cuba: <b>+22690360 o +52550234.</b></p>'),
  (15,10,2,'Do you want to know about our associations and coverage?','<p>We are open to anyone wishing to join our Ministry with the condition of Love, Loyalty and Loyalty. We are also more willing to receive seminars based on the well-being of families and the apostolic and prophetic foundation.</p><p>If you are interested in working with us can contact us on the following numbers from Cuba: <b>+22690360 or +52550234.</b></p>');

COMMIT;

