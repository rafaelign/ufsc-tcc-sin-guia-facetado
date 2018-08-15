<script>
    import DynamicForm from './DynamicForm'

    const data = [
        {
            "type": "is-12",
            "fields": [
                {"type": "select"},
                {"type": "select"},
            ]
        },
        {
            "type": "is-3",
            "fields": [
                {"type": "select"},
                {"type": "options"},
                {"type": "interval"}
            ]
        }
    ];

    const data2 = [{"id":1,"user":{"first_name":"Jesse","last_name":"Simmons"},"date":"2016/10/15 13:43:27","gender":"Male"},
        {"id":2,"user":{"first_name":"John","last_name":"Jacobs"},"date":"2016/12/15 06:00:53","gender":"Male"}];

    export default {
        components: {
            DynamicForm
        },
        props: {
            title: {
                type: String,
                default: null
            }
        },
        data: function () {
            return {
                data2,
                isSwitchedCustom: 'Baixo'
            }
        }
    }
</script>

<template>
    <div class="modal-content modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">{{ title }}</p>
        </header>
        <section class="modal-card-body">
            <form action="">
                <div class="tile is-ancestor">
                    <div class="tile is-vertical is-12">
                        <div class="tile is-parent">
                            <article class="tile is-child notification is-white">
                                <p class="subtitle">Grupo</p>
                                <div class="content">
                                    <div class="columns">
                                        <div class="column is-3">
                                            <b-field label="Simple">
                                                <b-select placeholder="Select a name">
                                                    <option
                                                            v-for="option in data2"
                                                            :value="option.id"
                                                            :key="option.id">
                                                        {{ option.user.first_name }}
                                                    </option>
                                                </b-select>
                                            </b-field>
                                        </div>
                                        <div class="column is-3">
                                            <b-field label="Simple">
                                                <b-select placeholder="Select a name">
                                                    <option
                                                            v-for="option in data2"
                                                            :value="option.id"
                                                            :key="option.id">
                                                        {{ option.user.first_name }}
                                                    </option>
                                                </b-select>
                                            </b-field>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="tile">
                            <div class="tile is-parent">
                                <article class="tile is-child notification is-white">
                                    <p class="subtitle">Grupo 2</p>
                                    <div class="content">
                                        <div class="field">
                                            <small>Radio Button</small>
                                            <b-field>
                                            <b-radio-button v-model="radioButton"
                                                            native-value="Nop"
                                                            type="is-danger">
                                                <b-icon icon="close"></b-icon>
                                                <span>Nop</span>
                                            </b-radio-button>

                                            <b-radio-button v-model="radioButton"
                                                            native-value="Yep"
                                                            type="is-success">
                                                <b-icon icon="check"></b-icon>
                                                <span>Yep</span>
                                            </b-radio-button>

                                            <b-radio-button v-model="radioButton"
                                                            native-value="Default">
                                                Default
                                            </b-radio-button>

                                            <b-radio-button v-model="radioButton"
                                                            native-value="Disabled"
                                                            disabled>
                                                Disabled
                                            </b-radio-button>
                                        </b-field>
                                        </div>

                                        <div class="field">
                                            <small>Radio</small>
                                            <br>
                                            <b-radio v-model="radio"
                                                     native-value="Flint">
                                                Flint
                                            </b-radio>
                                            <b-radio v-model="radio"
                                                     native-value="Silver">
                                                Silver
                                            </b-radio>
                                            <b-radio v-model="radio"
                                                     native-value="Jack">
                                                Jack
                                            </b-radio>
                                            <b-radio v-model="radio"
                                                     native-value="Vane"
                                                     disabled>
                                                Vane
                                            </b-radio>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="tile is-parent">
                                <article class="tile is-child notification is-white">
                                    <p class="subtitle">Grupo 3</p>
                                    <div class="content">
                                        <div class="field">
                                            <small>Disponibilidade de tempo</small>
                                            <br>
                                            <b-switch v-model="isSwitchedCustom"
                                                      true-value="Alto"
                                                      false-value="Baixo"
                                                      size="is-medium">
                                                {{ isSwitchedCustom }}
                                            </b-switch>
                                        </div>

                                    </div>
                                </article>
                            </div>
                            <div class="tile is-parent">
                                <article class="tile is-child notification is-white">
                                    <p class="subtitle">Grupo 4</p>
                                    <div class="content">
                                        <div class="block">
                                            <div class="field">
                                                <b-checkbox size="is-medium">Basic 1</b-checkbox>
                                            </div>
                                            <div class="field">
                                                <b-checkbox size="is-medium">Basic 2</b-checkbox>
                                            </div>
                                            <div class="field">
                                                <b-checkbox size="is-medium">Basic 3</b-checkbox>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="tile is-parent">
                                <article class="tile is-child notification is-white">
                                    <p class="subtitle">Grupo 5</p>
                                    <div class="content">
                                        <div class="block">
                                            <small>Range example</small>
                                            <br>
                                            <input class="slider is-fullwidth is-medium is-primary is-circle" step="1" min="0" max="2" value="0" type="range">
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <footer class="modal-card-foot buttons is-centered">
            <button class="button is-large" type="button">
                <b-icon icon="eraser"></b-icon> <span>Limpar</span>
            </button>
            <button class="button is-large is-primary">
                <b-icon icon="filter"></b-icon> <span>Filtrar</span>
            </button>
        </footer>
    </div>
</template>