@startuml

class ContenuTheque{
    + getContenu() : List<Article>
    + addContenu(newContenu : Contenu)
    + delContenu(contenu : Contenue)
    + rechercheContenu(ordre : int) : Contenu
    + getContenus() : List<Contenu>
}

abstract class Contenu{
    - titre : String
    - ordre : int
    
    + getTitre() : String
    + getOrdre() : int
    + setTitre(newTitre : String)
    + setOrdre(newOrdre : int)
}

class Media{
    - chemin : String

    + getChemin() : String
    + setChemin(newChemin : String)
}

class Paragraphe{
    - texte : String

    + getTexte() : String
    + setTexte(newTexte : String)
}

class Article{
    - id : String
    - titre : String
    - datePublication : Date
    - description : String
    - motsCles : List<String>
    - tempsConsultation : int
    - etat : int
    - cptSignalement : int

    + getId() : String
    + getTitre() : String
    + getDatePublication() : Date
    + getDescription() : String
    + getTempsConsultation() : int
    + getNote() : int
    + getEtat() : int
    + getCptSignalement() : int

    + setTitre(newTitre : String)
    + setDescription(newDescription : String)
    + setMotsCles(newMotCles : List<String>)
    + setTempsConsultation (newTemps : int)
    + setNote(newNote : int)
    + setEtat(newEtat : int)
    + setCptSignalement()
}

class ArticleTheque{
    + getArticles() : List<Article>
    + addArticle(newArticle : Article)
    + delArticle(article : Article)
    + rechercheArticle(id : String) : Article
    + getArticlesSignales() : List<Article>
}

class MessageTheque{
    + getArticle() : Article
    + addArticle(newArticle : Article)
    + delArticle(article : Article)
    + rechercheArticle(id : String) : Article
    + getArticlesSignales() : List<Article>
}

class Message{
    - dateMessage : date
    - message : String

    + getDateMessage() : date
    + getMessage() : String
}

class User{
    - pseudo : String
    - nom : String
    - prenom : String
    - mail : String
    - motDePasse : String
    - ban : Bool
    
    + User(pseudo : String, nom : String, prenom : String, mail : String, motDePasse : String)

    + getPseudo() : String
    + getNom() : String
    + getPrenom() : String
    + getMail() : String
    + getMotDePasse() : String
    + isBan() : Bool
    
    + setMail(newMail : String)
    + setMotDePasse(newMotDePasse : String)
    + setBan(ban : Bool)
}

class UserTheque{
    + getUsers() : List<User>
    + addUser(newUser : User)
    + delUser(user : User)
    + rechercheUser(pseudo : String)
}

enum Role{
    Visiteur
    Utilisateur
    Redacteur
    Moderateur
    Administrateur
}

class FormTheque{
    + addForm(newFormulaire : Formulaire)
    + delForm(formulaire : Formulaire)
    + getForms() : List<Formulaire>
}

abstract class Formulaire{
    - id : String
    - pseudoUser : String
    - mailUser : String

    + getId() : String
    + getPseudoUser() : String
    + getMailUser() : String
}

class FormAide{
    - sujet : String
    - message : String

    + getSujet() : String
    + getMessage() : String
}

class FormContribution{
    - theme : String
    - dateEnvoie : date
    - liens : List<String> 

    + getTheme() : String
    + getDateEnvoie() : date
    + getLiens() : List<String>
}

interface ModeleNonConnected{
  + public accueil()
  + public economie()
  + public culture()
  + public politique()
  + public faitsdivers()
}

class ModeleVisiteur{
  + public Connecter()
  + public Connexion()
  + public Inscrire()
  + public Inscription()
}

interface ModeleConnected {
  + public isConnected() : Bool
  + public disconnect()
  + public goodReview()
  + public badReview()
  + public accessAccount()
  + public accessForm()
}

class ModeleUtilisateur{
  + public isUtilisateur() : Bool
}

class ModeleAdmin{
  + public isAdmin() : Bool
  + public banUser()
  + public gestionUser()
  + public unBanUser()
  + public changeUserRole()
  + public administrer()
}

class FormMgr{
}

class UserMgr{
}

class ArticleMgr{
}

interface IDataManager{
  + public createElement(String ...info) : Bool
  + public deleteElement(String id) : Bool
  + public updateElement(String ...articleInfo) : Bool
  + public getterElement(String id) : Element
}

interface Serializer{
  + public Serilize()
}

interface DeSerializer{
  + public DeSerilize()
}

class ContenuSerializer{
}

class ContenuDeSerializer{
}

Media --|> Contenu
Paragraphe --|> Contenu
ContenuTheque --> "*" Contenu

Article --> ContenuTheque
ArticleTheque --> "*" Article

Article --> MessageTheque

Message ..> User

User --> Role
UserTheque --> "*" User

MessageTheque "key : String" #--> "*" Message

UserMgr ..|> IDataManager
FormMgr ..|> IDataManager
ArticleMgr ..|> IDataManager

ArticleMgr --> ArticleTheque
FormMgr --> FormTheque
UserMgr --> UserTheque

ModeleVisiteur ..> User
ModeleVisiteur ..> ArticleTheque

ModeleUtilisateur ..> UserTheque
ModeleUtilisateur ..> ArticleTheque
ModeleUtilisateur ..> Formulaire

ModeleAdmin ..> UserTheque
ModeleAdmin ..> ArticleTheque
ModeleAdmin ..> FormTheque

FormTheque --> "*" Formulaire
FormAide --|> Formulaire
FormContribution --|> Formulaire

ModeleConnected --|> ModeleNonConnected
ModeleVisiteur ..|> ModeleNonConnected
ModeleAdmin ..|> ModeleConnected
ModeleUtilisateur ..|> ModeleConnected

ContenuSerializer ..|> Serializer
ContenuDeSerializer ..|> Serializer
ContenuDeSerializer ..> ContenuTheque
ContenuSerializer ..> ContenuTheque
ContenuDeSerializer ..> Contenu
ContenuSerializer ..> Contenu

@enduml