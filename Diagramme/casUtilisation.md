# Diagramme de cas d'utilisation
```plantuml
@startuml
left to right direction

actor Visiteur as v
actor Utilisateur as u
package Interne {
    skinparam actorStyle awesome
    actor Rédacteur as r
    actor Modérateur as m
    actor Administrateur as a
}

package Verax {
    usecase "Filtrer par thème" as UC1
    usecase "Voir un article" as UC2
    usecase "Recherche un article" as UC3
    usecase "Créer un compte" as UC4
    
    usecase "Se connecter" as UC5

    usecase "Evaluer un article" as UC6
    usecase "Contribuer" as UC7
    usecase "Modifier son profil" as UC8
    usecase "Signaler un article" as UC9
    usecase "Se déconnecter" as UC24
    usecase "Supprimer son profil" as UC25 

    usecase "Rédiger un article" as UC11
    usecase "Consulter les contributions" as UC12
    usecase "Supprimer des contributions" as UC27
    usecase "Archiver des contributions" as UC26
    usecase "Commenter des articles" as UC15
    usecase "Demander à faire valider un article" as UC14

    usecase "Voir les signalements" as UC16
    usecase "Supprimer un utilisateur" as UC17
    usecase "Supprimer un article" as UC18
    usecase "Valider un article" as UC13
    usecase "Voir les actions des modérateurs" as UC19
    usecase "Réfuter un article" as UC20

    usecase "Gérer les modérateurs" as UC22
    usecase "Gérer les roles" as UC23
}

u --|> v
r --|> u
m --|> r
a --|> m

v --> UC1
v --> UC2
v --> UC3
v --> UC4
v --> UC5

u --> UC6
u --> UC7
u --> UC8
u --> UC9
u --> UC24
u --> UC25

r --> UC11
r --> UC12
r --> UC14
r --> UC15
r --> UC27
r --> UC26

m --> UC13
m --> UC16
m --> UC17
m --> UC18
m --> UC19
m --> UC20

a --> UC22
a --> UC23

UC6 ..> UC5
UC7 ..> UC5
UC8 ..> UC5
UC9 ..> UC5
UC24 ..> UC5
UC25 ..> UC5
UC11 ..> UC5
UC12 ..> UC5
UC14 ..> UC5
UC15 ..> UC5
UC27 ..> UC5
UC26 ..> UC5
UC13 ..> UC5
UC16 ..> UC5
UC17 ..> UC5
UC18 ..> UC5
UC19 ..> UC5
UC20 ..> UC5
UC22 ..> UC5
UC23 ..> UC5

@enduml
```

