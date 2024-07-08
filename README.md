
## Опис файлів та їх функціональність

1. **src/**: Директорія для PHP класів, які відповідають за логіку додатку.
   - `User.php`: Клас для управління користувачами.
   - `Chat.php`: Клас для роботи з чатом за допомогою Workerman.

2. **public/**: Публічні файли доступні через веб.
   - `index.php`: Головна сторінка з формами реєстрації та входу.
   - `dashboard.php`: Особистий кабінет користувача після входу.
   - `add_friend.php`: Сторінка для додавання друзів.
   - `chat.php`: Сторінка чату, реалізована з використанням Workerman.

3. **assets/**: Ресурси, такі як CSS, JavaScript та зображення.
   - `css/`, `js/`, `img/`: Підкаталоги для стилів, скриптів та зображень відповідно.

4. **sql/**: SQL скрипти для створення та оновлення бази даних.
   - `create_tables.sql`: SQL скрипт для створення необхідних таблиц у базі даних.

## Інструкції зі встановлення

1. **Клонування репозиторію**:
   ```bash
   git clone https://github.com/valikoshka1996/Basic-Social-Network-Template.git
   cd basic-social-network
