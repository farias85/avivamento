# SQL Manager 2007 for MySQL 4.1.2.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : avivamento


SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

