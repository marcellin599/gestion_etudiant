# GESTION DES ÉTUDIANTS

Ce projet est une application web simple pour **gérer les étudiants** d’un établissement.  
Il permet d’ajouter, modifier, supprimer et lister les étudiants avec leurs informations personnelles et leur spécialité.

---

## Fonctionnalités

- Ajouter un étudiant avec :
  - Nom et prénom
  - Date de naissance
  - Sexe
  - Niveau (B1, B2, B3, M1, M2)
  - Spécialité
- Modifier les informations d’un étudiant existant
- Supprimer un étudiant
- Lister tous les étudiants dans un tableau interactif
- Interface simple et responsive grâce à **Bootstrap 5**

---

## Technologies utilisées

- **PHP** pour la logique serveur
- **MySQL / MariaDB** pour la base de données
- **Bootstrap 5** pour le design et les modales
- **HTML / CSS** pour la structure et le style

---

## Structure du projet


GESTION_ETUDIANT/
│
├─ index.php # Page principale avec la liste des étudiants
├─ add.php # Script pour ajouter un étudiant
├─ update.php # Script pour modifier un étudiant
├─ delete.php # Script pour supprimer un étudiant
├─ gestion.php # Fichier de connexion à la base de données
├─ style.css # Fichier de style personnalisé
└─ README.md # Ce fichier


---

## Base de données

- Nom de la base : `gestion_etudiant`
- Tables principales :
  - `etudiant` : informations des étudiants
  - `specialite` : liste des spécialités disponibles

Exemple de script SQL pour créer la base et les tables :  

```sql
CREATE DATABASE IF NOT EXISTS gestion_etudiant;
USE gestion_etudiant;

CREATE TABLE specialite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL
);

CREATE TABLE etudiant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    date_naissance DATE NOT NULL,
    sexe ENUM('M','F') NOT NULL,
    niveau ENUM('B1','B2','B3','M1','M2') NOT NULL,
    specialite INT NOT NULL,
    FOREIGN KEY (specialite) REFERENCES specialite(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

⚠️ Remarque : la base de données n’est pas incluse dans le dépôt GitHub. Il faudra l’importer manuellement avec le script SQL ci-dessus.

### Quelques illustrations:

<img width="1887" height="955" alt="Capture d&#39;écran 2026-03-25 125901" src="https://github.com/user-attachments/assets/3d94f69e-0294-4299-92e2-103242444131" />
<img width="1858" height="947" alt="Capture d&#39;écran 2026-03-25 125826" src="https://github.com/user-attachments/assets/de16c0e1-c2c7-4306-a6a1-56df7cecce27" />
<img width="1861" height="912" alt="Capture d&#39;écran 2026-03-25 130516" src="https://github.com/user-attachments/assets/6bd1345f-8544-49dc-ad6d-94640ce10477" />
<img width="1853" height="897" alt="Capture d&#39;écran 2026-03-25 130623" src="https://github.com/user-attachments/assets/7fb4d873-e2ff-4647-a9df-f2527087abec" />



