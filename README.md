# TaxiYa

## 🚖 Nom du projet
**TaxiYa** – Plateforme digitale pour les Grands Taxis au Maroc

---

## 🎯 Contexte du projet
Au Maroc, **8 millions de personnes utilisent quotidiennement les Grands Taxis** (6 places).  
Le système actuel présente plusieurs problèmes :
- Temps d’attente imprévisible
- Manque d’information sur les trajets et les prix
- Expérience client médiocre (pas de réservation, pas de garantie de départ)
- Inefficacité pour les chauffeurs (temps morts, revenus irréguliers)

**TaxiYa** transforme ce système en une **expérience digitale fluide et efficace** pour voyageurs et chauffeurs.

---

## 🛠️ Fonctionnalités principales (MVP)

### Pour les voyageurs
- Rechercher un trajet (départ, arrivée, date)
- Filtrer les trajets (prix, heure, type de place)
- Voir le détail des trajets (places disponibles, prix)
- Réserver une ou plusieurs places
- Recevoir un email de confirmation

### Pour les chauffeurs
- Créer un compte (validation admin)
- Publier un trajet avec date, heure et prix
- Optimiser le remplissage de leur taxi

### Fonctionnalités bonus
- Page “Mes réservations” pour les voyageurs
- Annulation d’une réservation
- QR code pour validation des passagers
- Hébergement gratuit en ligne (Render/Heroku/Vercel)

---

## 📦 Architecture du projet

- **Backend** : Laravel (PHP)  
- **Frontend** : Blade / Bootstrap  
- **Base de données** : MySQL ou PostgreSQL  

### Classes principales

| Classe      | Rôle / Description |
|------------|------------------|
| `User`     | Classe parent pour l'authentification et informations communes |
| `Voyageur` | Hérite de User, recherche trajets, réservation, historique |
| `Chauffeur`| Hérite de User, crée trajets, possède un Taxi |
| `Taxi`     | Représente le véhicule physique, lié à Chauffeur |
| `Trajet`   | Entité logique d'une course, contient Places |
| `Place`    | 6 places par Trajet, type avant/arrière, statut disponible/réservée |
| `Reservation` | Représente le ou les places réservées par un Voyageur |
| `Notification` | Envoie email de confirmation pour réservation |

---

### Relations UML
Chauffeur 1 ─── 1 Taxi
Trajet 1 ─── 6 Place
Voyageur 1 ─── 0..* Reservation
Reservation 1 ─── 1..* Place
Reservation 1 ─── 0..1 Notification

- **Taxi ↔ Trajet** : pas de lien (selon instructions professeur)  
- **Reservation ↔ Trajet** : implicit via Place  
- **Chauffeur ↔ Trajet** : relation logique via leur Taxi

---

## ⚡ Règles métier

- Un taxi a exactement 6 places  
- Une place ne peut être réservée qu’une seule fois par trajet  
- Les places avant peuvent coûter 20% de plus (bonus)  
- Les trajets récurrents sont possibles (bonus)  
- Système de notation simple pour les chauffeurs (bonus)  


