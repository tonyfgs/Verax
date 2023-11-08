# Diagramme de cas d'utilisation
```plantuml
@startuml
left to right direction

actor Visiteur as v
actor Connecteur as c
actor Utilisateur as u
package Interne {
    skinparam actorStyle awesome
    actor Rédacteur as r
    actor Modérateur as m
    actor Administateur as a
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

    usecase "Remplir le formulaire" as UC10

    usecase "Rédiger un article" as UC11
    usecase "Vérifier les formulaires" as UC12
    usecase "Donner son accord pour un article" as UC13
    usecase "Publier un article" as UC14
    usecase "Commenter l'article" as UC15

    usecase "Voir les signalements" as UC16
    usecase "Supprimer un utilisateur" as UC17
    usecase "Supprimer un article" as UC18
    usecase "Voir les actions des modérateurs" as UC19
    usecase "Voir les bannissements utilisateurs" as UC20
    usecase "Voir les suppressions (temporaires) des articles" as UC21

    usecase "Gérer les modérateurs" as UC22
    usecase "Gérer les roles" as UC23
}

c --|> v
u --|> c
r --|> u
m --|> r
a --|> m

v --> UC1
v --> UC2
v --> UC3
v --> UC4
v --> UC5

c .> UC5 : include

u --> UC6
u --> UC7
u --> UC8
u --> UC9
u --> UC24

UC9 .> UC10 : inlcude
UC11 .> UC10 : inlcude
UC13 .> UC15 : inlcude
UC14 .> UC13 : inlcude

r --> UC11
r --> UC12
r --> UC13
r --> UC14

UC21 --|> UC19
UC20 --|> UC19

m --> UC16
m --> UC17
m --> UC18
m --> UC19

a --> UC22
a --> UC23



@enduml
```

