# Invictus - Gaming Community Platform

A PHP-based web application for gaming enthusiasts to review games, participate in tournaments, and manage gaming communities.

## Project Overview

Invictus is a social gaming platform that enables users to:
- Create and manage user profiles
- Review and rate games
- Participate in tournaments
- Join gaming communities
- Access gaming calendar events

## Architecture

### Technology Stack
- **Backend**: PHP with PDO (MySQL)
- **Frontend**: HTML, CSS, JavaScript
- **Libraries**: jQuery, jQuery Validation, Slick Carousel
- **Database**: MySQL

### Project Structure
```
MP0487_RA5RA6_Invictus/
├── Controller/          # Business logic layer
│   ├── GameController.php
│   └── UserController.php
├── Model/              # Data layer
│   ├── User.php
│   ├── Game.php
│   ├── Calendar.php
│   └── Invictus.sql
├── View/               # Presentation layer
│   ├── admin/
│   ├── games/
│   ├── login/
│   ├── profile/
│   ├── settings/
│   ├── signin/
│   └── ...
└── README.md
```

---

## Class Diagram

```mermaid
classDiagram
    class User {
        -id: int
        -email: string
        -username: string
        -surname: string
        -nickname: string
        -password: string
        -description: string
        -num_resenyas: int
        -num_torneos: int
        -num_comunidades: int
        -user_admin: boolean
        -num_ban: int
        -imagePath: string
        
        +getId(): int
        +setId(id: int)
        +getEmail(): string
        +setEmail(email: string)
        +getUsername(): string
        +setUsername(username: string)
        +getPassword(): string
        +setPassword(password: string)
        +getDescription(): string
        +setDescription(description: string)
    }

    class Game {
        -id: int
        -name: string
        -gender: string
        -release_date: date
        -description: string
        -developer: string
        -img_game_path: string
        
        +getId(): int
        +setId(id: int)
        +getName(): string
        +setName(name: string)
        +getReleaseDate(): date
        +setReleaseDate(date: date)
        +getDescription(): string
        +setDescription(description: string)
        +getDeveloper(): string
        +setDeveloper(developer: string)
    }

    class Calendar {
        -id: int
        -event_name: string
        -event_date: date
        -event_description: string
        
        +getId(): int
        +getEventName(): string
        +getEventDate(): date
        +getEventDescription(): string
    }

    class UserController {
        -conn: PDO
        
        +__construct()
        +login()
        +logout()
        +register()
        +registerAdmin()
        +uploadImg(user: User)
        +updateData(user: User)
        +deleteAccount(user: User)
        -validateEmail(): boolean
        -encryptPassword(): string
    }

    class GameController {
        -conn: PDO
        
        +__construct()
        +initGamesView(user: User)
        +createGame(lista: array, user: User)
        +updateGame(lista: array, user: User)
        +deleteGame(user: User)
        +getGameById(id: int): Game
        +getAllGames(): array
    }

    UserController --> User: manages
    GameController --> Game: manages
    User --> Calendar: participates in
    Game --> Calendar: featured in
```

---

## Sequence Diagram - User Login Flow

```mermaid
sequenceDiagram
    participant User as User (Browser)
    participant View as View Layer<br/>(login.php)
    participant Controller as UserController
    participant Database as Database<br/>(MySQL)

    User->>View: Enter credentials & submit form
    activate View
    View->>View: Validate form data
    View->>Controller: POST login request
    activate Controller
    
    Controller->>Controller: Validate input
    Controller->>Database: Query user by email
    activate Database
    Database-->>Controller: User record
    deactivate Database
    
    Controller->>Controller: Verify password hash
    
    alt Authentication Successful
        Controller->>Controller: Create session
        Controller->>Database: Update last login
        activate Database
        deactivate Database
        Controller-->>View: Redirect to dashboard
        View-->>User: Display dashboard
    else Authentication Failed
        Controller-->>View: Return error message
        View-->>User: Display error & login form
    end
    
    deactivate Controller
    deactivate View
```

---

## Sequence Diagram - Game Creation Flow

```mermaid
sequenceDiagram
    participant User as User (Admin)
    participant View as View Layer<br/>(games.php)
    participant Controller as GameController
    participant Database as Database<br/>(MySQL)
    participant FileSystem as File System<br/>(Images)

    User->>View: Fill game form & submit
    activate View
    View->>View: Validate form data
    View->>Controller: POST create request with game data
    activate Controller
    
    Controller->>Controller: Validate game data
    
    alt Image Upload Present
        Controller->>FileSystem: Save game image
        activate FileSystem
        FileSystem-->>Controller: Image path
        deactivate FileSystem
    end
    
    Controller->>Database: INSERT new game record
    activate Database
    Database-->>Controller: Game created (ID returned)
    deactivate Database
    
    Controller->>Database: UPDATE user game count
    activate Database
    deactivate Database
    
    Controller-->>View: Success message with game ID
    View-->>User: Display success & redirect to games list
    
    deactivate Controller
    deactivate View
```

---

## Database Schema

### Users Table
```sql
- id (PRIMARY KEY)
- email (UNIQUE)
- username (UNIQUE)
- surname
- nickname
- password (hashed)
- description
- num_resenyas
- num_torneos
- num_comunidades
- user_admin (BOOLEAN)
- num_ban
- imagePath
```

### Games Table
```sql
- id (PRIMARY KEY)
- name
- gender
- release_date
- description
- developer
- img_game_path
```

### Calendar Table
```sql
- id (PRIMARY KEY)
- event_name
- event_date
- event_description
```

---

## Features

### User Management
- User registration and authentication
- Profile management
- Image upload functionality
- Account deletion
- Admin registration

### Game Management
- Create, read, update, delete games
- Game categorization by gender/genre
- Game reviews and ratings
- Developer information tracking
- Game image gallery

### Community Features
- Calendar events management
- Tournament participation
- Community memberships
- User review system

---

## Installation

1. **Clone/Extract** the project to `htdocs` folder
2. **Create Database**: Import `Model/Invictus.sql` into MySQL
3. **Configure Database**: Update connection credentials in controllers
4. **Start Server**: Run Apache and MySQL via XAMPP
5. **Access Application**: Navigate to `http://localhost/MP0487/MP0487_RA5RA6_Invictus/View/index/index.php`

---

## Development Notes

- Uses **MVC (Model-View-Controller)** architecture
- **PDO** for secure database queries with parameterized statements
- **Session management** for user authentication
- **Form validation** with jQuery Validation plugin
- **Responsive design** with Bootstrap and Slick carousel for games

---

## Future Enhancements

- Real-time notifications
- Advanced search and filtering
- Social features (friends, messaging)
- Tournament bracket system
- Payment integration for premium features
- API development

---

## License

Confidential - Educational Project (RA5/RA6)
