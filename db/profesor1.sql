-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2022 a las 05:56:11
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `profesor1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumnos` int(10) NOT NULL,
  `dni` varchar(300) NOT NULL,
  `nombres` varchar(150) NOT NULL,
  `ap_paterno` varchar(50) NOT NULL,
  `ap_materno` varchar(50) DEFAULT NULL,
  `genero` char(2) NOT NULL,
  `edad` int(2) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `celular` int(9) NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumnos`, `dni`, `nombres`, `ap_paterno`, `ap_materno`, `genero`, `edad`, `correo`, `celular`, `fecha_registro`, `fecha_actualizacion`) VALUES
(1, '75349879', 'alonso', 'villa', 'verde', 'M', 30, 'djiuetewr@gmail.com', 954763218, '2022-04-28', '2022-08-31 01:16:24'),
(2, '78647924', 'pedro', 'burgos', 'llaye', 'M', 20, 'pbu@gmail.com', 935478616, '2022-08-02', '2022-08-31 01:48:35'),
(3, '$2y$05$fJryP.S9KjzsgGpm7jXs0exLz9UxYnzA7KmBcEnmkilyS8gCarWtW', 'proyectoalesus', 'hfhfhf', 'fhgfhf', 'F', 14, 'hhkhj', 444444444, '2022-09-24', '2022-09-24 03:39:10'),
(4, '$2y$05$X3mqAOJviEDLu23bwzxuR.VFrNGNTggYoIFb0EhdgtwvaDyHrFXU.', 'alesus2022', 'fsfdsgffg', 'fhfghfhf', 'M', 25, 'fsfsfsdf@', 955577777, '2022-09-24', '2022-09-24 03:42:45'),
(5, '$2y$05$aia5jlZXgPj.5FQjDCHVf.eFe92MG1IxGvKMqDMa4sdTpWECcMDf6', 'alesus', 'fhhgfghf', 'hfghfghfg', 'O', 30, 'gdgd@gmail.com', 999988777, '2022-09-24', '2022-09-24 03:50:06'),
(6, '$2y$05$9RxWmHr/OUCZTaetmIkxjuMrqnR9voFeSUPWFjbdjI/Sf433gDdOa', 'bony', 'roboredo', 'rondon', 'M', 24, 'rebor@gmail.com', 958743541, '2022-09-24', '2022-09-24 04:29:11'),
(7, '$2y$05$6Ow9I96shkaCf3ETNAHqBeBwbgMyMd7LkizGlj1ARgvPjo5Io7Rlq', 'jhacson', 'soter', 'ferran', 'M', 18, 'jhacson@gmail.com', 956987456, '2022-09-28', '2022-09-27 23:35:04'),
(8, '$2y$05$BJa5WMuyJPEMGs9vKXbzv.ZqjpogJVkO3aIY7u3Ajph6XGNQbOd.2', 'marita', 'palermo', 'santos', 'F', 17, 'mari@gmail.com', 965783547, '2022-09-30', '2022-09-30 01:24:09'),
(9, '$2y$05$UukzrBtixzDYr7Q.HVd6heBA0Aro0OM9pi6GMQvTwAXrZv7jcvbMy', 'marita', 'palermo', 'santos', 'F', 18, 'mary@gmail.com', 964788553, '2022-09-30', '2022-09-30 01:27:25'),
(10, '$2y$05$IGTGXzkq9tLXSAVpphP5qeePNkiDzJK1AXcXHIQ1SG8hpSOhnEhLW', 'luna', 'borre', 'almiron', 'M', 25, 'luna@gmail.com', 975431288, '2022-09-30', '2022-09-30 02:02:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores_fuente`
--

CREATE TABLE `colores_fuente` (
  `id_colFuente` int(10) NOT NULL,
  `color_fuente_1` varchar(7) NOT NULL,
  `color_fuente_2` varchar(7) NOT NULL,
  `color_fuente_3` varchar(7) NOT NULL,
  `color_fuente_4` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color_fondos`
--

CREATE TABLE `color_fondos` (
  `id_fondo` int(10) NOT NULL,
  `pincel_1` varchar(7) NOT NULL,
  `pincel_2` varchar(7) NOT NULL,
  `pincel_3` varchar(7) NOT NULL,
  `pincel_4` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `id_configuracion` int(10) NOT NULL,
  `disponivilidad_registro` varchar(2) NOT NULL,
  `disponivilidad_diseño` varchar(2) NOT NULL,
  `id_imgPortada` int(10) NOT NULL,
  `id_fondo` int(10) NOT NULL,
  `id_fuente` int(10) NOT NULL,
  `id_colFuente` int(10) NOT NULL,
  `id_imgAnimado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correo_ingreso`
--

CREATE TABLE `correo_ingreso` (
  `id_correo` int(10) NOT NULL,
  `pass01` varchar(200) NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_cursos` int(10) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `nivel` varchar(30) DEFAULT NULL,
  `link` varchar(100) NOT NULL,
  `disponivilidad` char(2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `id_local` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_cursos`, `titulo`, `descripcion`, `nivel`, `link`, `disponivilidad`, `fecha_inicio`, `fecha_fin`, `id_local`) VALUES
(1, 'Desarrollo web frond-end', 'Trabaja la interfaz de usuario desde el punto de vista del código, encárgate de la parte visual de una pagina web.', '80', 'https://www.idat.edu.pe/cursos-de-formacion-continua/diseno-y-desarrollo-web', 'F', '2022-05-01', '2022-08-31', 1),
(5, 'HTML5', 'Es un estandar que sirve como referencia del softwar que conecta con la elaboració de la página web en sus diferentes versiones, define una estructura basica y un cosigo (denominado html).', '50', 'https://www.arkaitzgarro.com/html5/capitulo-1.html', 'V', '2022-08-02', '2023-02-15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_alumnos`
--

CREATE TABLE `cursos_alumnos` (
  `id_curso` int(10) NOT NULL,
  `id_alumno` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos_alumnos`
--

INSERT INTO `cursos_alumnos` (`id_curso`, `id_alumno`) VALUES
(1, 1),
(5, 2),
(5, 2),
(5, 2),
(5, 2),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(5, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cv_docente`
--

CREATE TABLE `cv_docente` (
  `id_cv` int(10) NOT NULL,
  `DNI` varchar(100) NOT NULL,
  `nombres` varchar(150) NOT NULL,
  `ap_paterno` varchar(45) NOT NULL,
  `ap_materno` varchar(45) DEFAULT NULL,
  `telefono` int(8) DEFAULT NULL,
  `celular` int(9) NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cv_docente`
--

INSERT INTO `cv_docente` (`id_cv`, `DNI`, `nombres`, `ap_paterno`, `ap_materno`, `telefono`, `celular`, `fecha_registro`, `fecha_actualizacion`) VALUES
(1, '74022294', 'Jesús Bonnelee', 'Zubilete', 'Díaz', 2859952, 910507409, '2022-06-19', '2022-06-25 22:03:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `date_cursos`
--

CREATE TABLE `date_cursos` (
  `id_dcurso` int(10) NOT NULL,
  `curso_ejercido` varchar(100) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `nivel_porcentaje` int(3) DEFAULT NULL,
  `lugar` varchar(200) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_cv` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `date_cursos`
--

INSERT INTO `date_cursos` (`id_dcurso`, `curso_ejercido`, `descripcion`, `nivel_porcentaje`, `lugar`, `fecha_inicio`, `fecha_fin`, `fecha_actualizacion`, `id_cv`) VALUES
(1, 'JavaScript', 'Es un lenguaje de programación que se usa para añadir características interactivas a tu sitio web', 50, 'cesca - Av. alfonso ugarte', '2018-05-15', '2018-08-10', '2022-06-19 20:52:24', 1),
(2, 'html5', 'HTML5 (HyperText Markup Language, versión 5) es la quinta revisión del lenguaje HTML y permite definir los nuevos estándares de desarrollo web, modificando el código existente para solucionar problemas y actualizándolo a las nuevas necesidades de hoy en día.', 80, 'Av. Petit Thouars 315, Cercado de Lima 15046', '2022-05-15', '2022-12-10', '2022-08-19 03:55:06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `date_laboral`
--

CREATE TABLE `date_laboral` (
  `id_experiencia` int(10) NOT NULL,
  `experiencia` varchar(150) NOT NULL,
  `lugar` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_cv` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `date_laboral`
--

INSERT INTO `date_laboral` (`id_experiencia`, `experiencia`, `lugar`, `fecha_inicio`, `fecha_fin`, `fecha_actualizacion`, `id_cv`) VALUES
(1, 'Profesor de HTML', 'Computrabajo av. uruguay', '2021-05-15', '2021-12-10', '2022-06-19 20:29:20', 1),
(2, 'css3', 'Av. Petit Thouars 315, Cercado de Lima 15046', '2016-05-15', '2018-08-10', '2022-08-19 03:57:03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_curso_cursos`
--

CREATE TABLE `detalles_curso_cursos` (
  `id_curso` int(10) NOT NULL,
  `id_decurso` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalles_curso_cursos`
--

INSERT INTO `detalles_curso_cursos` (`id_curso`, `id_decurso`) VALUES
(1, 1),
(1, 2),
(1, 4),
(5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_curso`
--

CREATE TABLE `detalle_curso` (
  `id_decurso` int(10) NOT NULL,
  `curso` varchar(100) NOT NULL,
  `detalle` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_curso`
--

INSERT INTO `detalle_curso` (`id_decurso`, `curso`, `detalle`) VALUES
(1, 'HTML', 'HTML5 (HyperText Markup Language, versión 5) es la quinta revisión del lenguaje HTML y permite definir los nuevos estándares de desarrollo web, modificando el código existente para solucionar problemas y actualizándolo a las nuevas necesidades de hoy en día.'),
(2, 'javaScript', 'JavaScript es el lenguaje de programación que debes usar para añadir características interactivas a tu sitio web, (por ejemplo, juegos, eventos que ocurren cuando los botones son presionados o los datos son introducidos en los formularios, efectos de estilo dinámicos, animación, y mucho más)'),
(3, 'PHP', 'El lenguaje PHP, es un lenguaje de programación que permite el desarrollo web o aplicaciones web dinámicas, el cual es apto para incrustar el lenguaje HTML, ahora bien, siempre siguiendo algunas reglas establecidas. Además, el lenguaje PHP favorece a la conexión entre el servidor y a la interfaz del usuario'),
(4, 'CSS', 'CSS es un lenguaje de diseño gráfico que permite definir y crear la presentación de un documento estructurado escrito en un lenguaje de marcado. Es muy usado para establecer el diseño visual de los documentos web e interfaces de usuario escritas en HTML.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `id_nota` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `id_curso` int(10) NOT NULL,
  `id_rango` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_alumnos`
--

CREATE TABLE `evaluaciones_alumnos` (
  `id_nota` int(10) NOT NULL,
  `id_alumno` int(10) NOT NULL,
  `nota_numero` int(2) NOT NULL,
  `nota_palabras` varchar(50) NOT NULL,
  `resena` varchar(300) DEFAULT NULL,
  `fecha_nota` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuentes_letra`
--

CREATE TABLE `fuentes_letra` (
  `id_fuente` int(10) NOT NULL,
  `fuente_1` varchar(50) NOT NULL,
  `fuente_2` varchar(50) NOT NULL,
  `fuente_3` varchar(50) NOT NULL,
  `fuente_4` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_animados`
--

CREATE TABLE `img_animados` (
  `id_imgAnimados` int(10) NOT NULL,
  `anime_1` blob NOT NULL,
  `anime_2` blob NOT NULL,
  `anime_3` blob NOT NULL,
  `anime_4` blob NOT NULL,
  `anime_5` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_portada`
--

CREATE TABLE `img_portada` (
  `id_imgPortada` int(10) NOT NULL,
  `portada_1` blob NOT NULL,
  `portada_2` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institutos`
--

CREATE TABLE `institutos` (
  `id_local` int(10) NOT NULL,
  `instituto` varchar(50) NOT NULL,
  `av_local` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `institutos`
--

INSERT INTO `institutos` (`id_local`, `instituto`, `av_local`) VALUES
(1, 'Idat - Cercado de Lima', 'Av. Petit Thouars 315, Cercado de Lima 15046'),
(2, 'Cesca - Cercado de Lima', 'Jirón Recuay 141, Cercado de Lima 15082');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rangos`
--

CREATE TABLE `rangos` (
  `id_rango` int(10) NOT NULL,
  `tipo_evaluacion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rangos`
--

INSERT INTO `rangos` (`id_rango`, `tipo_evaluacion`) VALUES
(1, 'clase presencial'),
(5, 'clase virtual'),
(3, 'examen presencial'),
(4, 'examen virtual'),
(8, 'practica presencial'),
(9, 'practica virtual'),
(2, 'tarea');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redes_sociales`
--

CREATE TABLE `redes_sociales` (
  `id_rsocial` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `link` varchar(100) NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_cv` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `redes_sociales`
--

INSERT INTO `redes_sociales` (`id_rsocial`, `nombre`, `correo`, `link`, `fecha_actualizacion`, `id_cv`) VALUES
(1, 'facebook', '@jesusbonnelee', 'https://www.facebook.com/jesusbonnele.zubiletediaz.5', '2022-06-30 03:27:43', 1),
(2, 'html', '@martin', 'http://localhost:86/profesor1/views/mister.php', '2022-08-19 02:31:36', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segurityalumn`
--

CREATE TABLE `segurityalumn` (
  `id_alumno` int(10) DEFAULT NULL,
  `id_correo` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguritymister`
--

CREATE TABLE `seguritymister` (
  `id_cv` int(10) DEFAULT NULL,
  `id_correo` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumnos`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`),
  ADD UNIQUE KEY `id_alumnos_UNIQUE` (`id_alumnos`);

--
-- Indices de la tabla `colores_fuente`
--
ALTER TABLE `colores_fuente`
  ADD PRIMARY KEY (`id_colFuente`),
  ADD UNIQUE KEY `id_colFuente_UNIQUE` (`id_colFuente`);

--
-- Indices de la tabla `color_fondos`
--
ALTER TABLE `color_fondos`
  ADD PRIMARY KEY (`id_fondo`),
  ADD UNIQUE KEY `id_fondo_UNIQUE` (`id_fondo`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`id_configuracion`),
  ADD UNIQUE KEY `id_configuracion_UNIQUE` (`id_configuracion`),
  ADD KEY `imgPortada_configuracion_idx` (`id_imgPortada`),
  ADD KEY `colorFondo_configuracion_idx` (`id_fondo`),
  ADD KEY `fuenteLetra_configuracion_idx` (`id_fuente`),
  ADD KEY `colorFuente_configuracion_idx` (`id_colFuente`),
  ADD KEY `imgAnimado_configuracion_idx` (`id_imgAnimado`);

--
-- Indices de la tabla `correo_ingreso`
--
ALTER TABLE `correo_ingreso`
  ADD PRIMARY KEY (`id_correo`),
  ADD UNIQUE KEY `id_correo_UNIQUE` (`id_correo`),
  ADD UNIQUE KEY `pass01_UNIQUE` (`pass01`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_cursos`),
  ADD UNIQUE KEY `id_cursos_UNIQUE` (`id_cursos`),
  ADD UNIQUE KEY `link_UNIQUE` (`link`),
  ADD KEY `cursos_idx` (`id_local`);

--
-- Indices de la tabla `cursos_alumnos`
--
ALTER TABLE `cursos_alumnos`
  ADD KEY `curso_alumnos_idx` (`id_curso`),
  ADD KEY `alumno_cursos_idx` (`id_alumno`);

--
-- Indices de la tabla `cv_docente`
--
ALTER TABLE `cv_docente`
  ADD PRIMARY KEY (`id_cv`),
  ADD UNIQUE KEY `id_cv_UNIQUE` (`id_cv`),
  ADD UNIQUE KEY `DNI` (`DNI`);

--
-- Indices de la tabla `date_cursos`
--
ALTER TABLE `date_cursos`
  ADD PRIMARY KEY (`id_dcurso`),
  ADD UNIQUE KEY `id_curso_UNIQUE` (`id_dcurso`),
  ADD KEY `cursos_ejercidos_idx` (`id_cv`);

--
-- Indices de la tabla `date_laboral`
--
ALTER TABLE `date_laboral`
  ADD PRIMARY KEY (`id_experiencia`),
  ADD UNIQUE KEY `id_experiencia_UNIQUE` (`id_experiencia`),
  ADD KEY `experiencia_idx` (`id_cv`);

--
-- Indices de la tabla `detalles_curso_cursos`
--
ALTER TABLE `detalles_curso_cursos`
  ADD KEY `detalles_curso_idx` (`id_decurso`),
  ADD KEY `curso_detalles` (`id_curso`);

--
-- Indices de la tabla `detalle_curso`
--
ALTER TABLE `detalle_curso`
  ADD PRIMARY KEY (`id_decurso`),
  ADD UNIQUE KEY `id_decurso_UNIQUE` (`id_decurso`),
  ADD UNIQUE KEY `curso_UNIQUE` (`curso`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`id_nota`),
  ADD UNIQUE KEY `id_nota_UNIQUE` (`id_nota`),
  ADD UNIQUE KEY `titulo_UNIQUE` (`titulo`),
  ADD KEY `curso_evaluaciones_idx` (`id_curso`),
  ADD KEY `rango_evaluaciones_idx` (`id_rango`);

--
-- Indices de la tabla `evaluaciones_alumnos`
--
ALTER TABLE `evaluaciones_alumnos`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `alumno_evaluaciones_idx` (`id_alumno`);

--
-- Indices de la tabla `fuentes_letra`
--
ALTER TABLE `fuentes_letra`
  ADD PRIMARY KEY (`id_fuente`),
  ADD UNIQUE KEY `id_fuente_UNIQUE` (`id_fuente`);

--
-- Indices de la tabla `img_animados`
--
ALTER TABLE `img_animados`
  ADD PRIMARY KEY (`id_imgAnimados`),
  ADD UNIQUE KEY `id_imgAnimados_UNIQUE` (`id_imgAnimados`);

--
-- Indices de la tabla `img_portada`
--
ALTER TABLE `img_portada`
  ADD PRIMARY KEY (`id_imgPortada`),
  ADD UNIQUE KEY `id_imgPortada_UNIQUE` (`id_imgPortada`);

--
-- Indices de la tabla `institutos`
--
ALTER TABLE `institutos`
  ADD PRIMARY KEY (`id_local`),
  ADD UNIQUE KEY `av_local_UNIQUE` (`av_local`),
  ADD UNIQUE KEY `id_local_UNIQUE` (`id_local`);

--
-- Indices de la tabla `rangos`
--
ALTER TABLE `rangos`
  ADD PRIMARY KEY (`id_rango`),
  ADD UNIQUE KEY `id_rango_UNIQUE` (`id_rango`),
  ADD UNIQUE KEY `tipo_evaluacion_UNIQUE` (`tipo_evaluacion`);

--
-- Indices de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  ADD PRIMARY KEY (`id_rsocial`),
  ADD UNIQUE KEY `id_social_UNIQUE` (`id_rsocial`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  ADD KEY `cuentas_idx` (`id_cv`);

--
-- Indices de la tabla `segurityalumn`
--
ALTER TABLE `segurityalumn`
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_correo` (`id_correo`);

--
-- Indices de la tabla `seguritymister`
--
ALTER TABLE `seguritymister`
  ADD KEY `id_cv` (`id_cv`),
  ADD KEY `id_correo` (`id_correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumnos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `colores_fuente`
--
ALTER TABLE `colores_fuente`
  MODIFY `id_colFuente` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `color_fondos`
--
ALTER TABLE `color_fondos`
  MODIFY `id_fondo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  MODIFY `id_configuracion` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `correo_ingreso`
--
ALTER TABLE `correo_ingreso`
  MODIFY `id_correo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_cursos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cv_docente`
--
ALTER TABLE `cv_docente`
  MODIFY `id_cv` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `date_cursos`
--
ALTER TABLE `date_cursos`
  MODIFY `id_dcurso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `date_laboral`
--
ALTER TABLE `date_laboral`
  MODIFY `id_experiencia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_curso`
--
ALTER TABLE `detalle_curso`
  MODIFY `id_decurso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `id_nota` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fuentes_letra`
--
ALTER TABLE `fuentes_letra`
  MODIFY `id_fuente` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `img_animados`
--
ALTER TABLE `img_animados`
  MODIFY `id_imgAnimados` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `img_portada`
--
ALTER TABLE `img_portada`
  MODIFY `id_imgPortada` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `institutos`
--
ALTER TABLE `institutos`
  MODIFY `id_local` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rangos`
--
ALTER TABLE `rangos`
  MODIFY `id_rango` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  MODIFY `id_rsocial` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD CONSTRAINT `colorFondo_configuracion` FOREIGN KEY (`id_fondo`) REFERENCES `color_fondos` (`id_fondo`),
  ADD CONSTRAINT `colorFuente_configuracion` FOREIGN KEY (`id_colFuente`) REFERENCES `colores_fuente` (`id_colFuente`),
  ADD CONSTRAINT `fuenteLetra_configuracion` FOREIGN KEY (`id_fuente`) REFERENCES `fuentes_letra` (`id_fuente`),
  ADD CONSTRAINT `imgAnimado_configuracion` FOREIGN KEY (`id_imgAnimado`) REFERENCES `img_animados` (`id_imgAnimados`),
  ADD CONSTRAINT `imgPortada_configuracion` FOREIGN KEY (`id_imgPortada`) REFERENCES `img_portada` (`id_imgPortada`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos` FOREIGN KEY (`id_local`) REFERENCES `institutos` (`id_local`);

--
-- Filtros para la tabla `cursos_alumnos`
--
ALTER TABLE `cursos_alumnos`
  ADD CONSTRAINT `alumno_cursos` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumnos`),
  ADD CONSTRAINT `curso_alumnos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_cursos`);

--
-- Filtros para la tabla `date_cursos`
--
ALTER TABLE `date_cursos`
  ADD CONSTRAINT `cursos_ejercidos` FOREIGN KEY (`id_cv`) REFERENCES `cv_docente` (`id_cv`);

--
-- Filtros para la tabla `date_laboral`
--
ALTER TABLE `date_laboral`
  ADD CONSTRAINT `experiencia` FOREIGN KEY (`id_cv`) REFERENCES `cv_docente` (`id_cv`);

--
-- Filtros para la tabla `detalles_curso_cursos`
--
ALTER TABLE `detalles_curso_cursos`
  ADD CONSTRAINT `curso_detalles` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_cursos`),
  ADD CONSTRAINT `detalle_cursos` FOREIGN KEY (`id_decurso`) REFERENCES `detalle_curso` (`id_decurso`);

--
-- Filtros para la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD CONSTRAINT `curso_evaluaciones` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_cursos`),
  ADD CONSTRAINT `rango_evaluaciones` FOREIGN KEY (`id_rango`) REFERENCES `rangos` (`id_rango`);

--
-- Filtros para la tabla `evaluaciones_alumnos`
--
ALTER TABLE `evaluaciones_alumnos`
  ADD CONSTRAINT `alumno_evaluaciones` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumnos`),
  ADD CONSTRAINT `evaluacion_alumnos` FOREIGN KEY (`id_nota`) REFERENCES `evaluaciones` (`id_nota`);

--
-- Filtros para la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  ADD CONSTRAINT `cuentas` FOREIGN KEY (`id_cv`) REFERENCES `cv_docente` (`id_cv`);

--
-- Filtros para la tabla `segurityalumn`
--
ALTER TABLE `segurityalumn`
  ADD CONSTRAINT `segurityalumn_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumnos`),
  ADD CONSTRAINT `segurityalumn_ibfk_2` FOREIGN KEY (`id_correo`) REFERENCES `correo_ingreso` (`id_correo`);

--
-- Filtros para la tabla `seguritymister`
--
ALTER TABLE `seguritymister`
  ADD CONSTRAINT `seguritymister_ibfk_1` FOREIGN KEY (`id_cv`) REFERENCES `cv_docente` (`id_cv`),
  ADD CONSTRAINT `seguritymister_ibfk_2` FOREIGN KEY (`id_correo`) REFERENCES `correo_ingreso` (`id_correo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
