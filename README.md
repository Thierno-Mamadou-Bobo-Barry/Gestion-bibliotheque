# 📚 Gestion de Bibliothèque — Laravel

Application web de gestion de bibliothèque développée avec **Laravel**.
Elle permet la gestion des **livres**, **catégories**, **auteurs**, **emprunts**, **retours**, **pénalités**, ainsi qu’une interface **Admin** pour la gestion des utilisateurs et statistiques.

---

## ✅ Fonctionnalités

### 👤 Authentification & Sécurité
- Connexion via **login (matricule)** + mot de passe
- Gestion des rôles :
  - **Radmin**
  - **Rbibliothecaire**
  - **Rlecteur**
- Comptes **actifs/inactifs** (un utilisateur désactivé ne peut pas se connecter)
- Accès protégé par middleware selon rôle

### 📚 Bibliothécaire
- CRUD **Livres**
- CRUD **Catégories**
- CRUD **Auteurs**
- Association :
  - Livre → Catégorie (1-N)
  - Livre ↔ Auteurs (N-N)
- Gestion des emprunts :
  - Validation du retour
  - Stock mis à jour automatiquement
  - Création de pénalité si retour en retard

### 👨‍🎓 Lecteur
- Catalogue des livres avec recherche (titre, ISBN, auteur, catégorie)
- Emprunter un livre (si disponible)
- Voir ses emprunts
- Voir ses pénalités

### 🧑‍💼 Admin
- Statistiques globales
- Gestion des utilisateurs (rôle + actif/inactif)

---

## 🧰 Prérequis

- PHP >= 8.2 (testé avec PHP 8.3)
- Composer
- Node.js + npm
- MySQL (ex: Laragon / XAMPP)

---

## 🚀 Installation (local)

### 1) Cloner le projet
```bash
git clone <URL_DU_REPO>
cd bibliotheque
