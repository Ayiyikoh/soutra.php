

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL,
  `matricule` varchar(8) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `dateNaiss` varchar(9) NOT NULL,
  `lieurNaiss` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


