           <form class="form form_type-admin" name="formReg" action="../../php/createSession.php">
                <input class="form__input" placeholder="Имя сессии" name="name" required>
                <input class="form__input" placeholder="Инфо" name="info">

                <select  class="form__input" name="game_id">
                    {OPTIONS}
              
                </select>
                <button class="button button_type-submit" type="submit">Добавить</button>
            </form>