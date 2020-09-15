<div class="session session-{STATE}" onclick={LINK}>
                    <p class="session__name">{NAME}</p>
                    <p class="session__info">{INFO}</p>
                    <p class="session__players">{PLAYERS}</p>
                    <button {HIDDEN} name="session" class="session__button session__button_type-join join-{STATE}" value="{SESSION_ID}">Подключиться</button>
</div>