
            <form class="form form_type-admin" name="formReg" action="../../php/userReg.php">
                <input class="form__input" placeholder="Имя" name="firstname" required>
                <input class="form__input" placeholder="Фамилия" name="lastname" required>
                <input class="form__input" placeholder="Отчество" name="middlename">
    
                <input class="form__input" placeholder="Имя пользователя" name="username" minlength="3" maxlength="20" required>
                <input class="form__input" placeholder="Пароль" type="password" name="password" required>
    
                <input class="form__input" placeholder="EMail" type="email" name="email" required>
                <button class="button button_type-submit" type="submit">Добавить</button>
            </form>