<script>
    import { mapMutations } from 'vuex'

    export default {
        props: {
            type: {
                type: String
            },
            options: {
                type: Array,
                default: () => {
                    return [];
                }
            },
            option: {
                type: String,
                default: null
            },
            name: {
                type: String,
                default: null
            },
        },
        data () {
            return {
                fieldValue: null,
                fieldName: null,
                switchConfig: {
                    trueValue: 1,
                    falseValue: 0
                },
                sliderConfig: {
                    step: 1,
                    min: 0,
                    max: 2
                }
            };
        },
        created () {
            if (this.type === 'switch') {
                this.switchConfig.falseValue = parseInt(this.options[0].id)
                this.switchConfig.trueValue = parseInt(this.options[1].id)

                this.addDefaultValue({
                    name: this.name,
                    value: this.switchConfig.falseValue
                })
            }

            if (this.type === 'slider') {
                this.sliderConfig.min = parseInt(this.options[0].value)
                this.sliderConfig.max = parseInt(this.options[ this.options.length - 1 ].value)

                this.addDefaultValue({
                    name: this.name,
                    value: this.sliderConfig.min
                })
            }

            if (this.type === 'checkbox' || this.type === 'checkbutton') {
                this.addDefaultValue({
                    name: this.name,
                    value: []
                })
            }

            this.fieldName = this.name
            this.fieldValue = this.getFilter(this.name)
        },
        methods: {
            ...mapMutations([
                'addFilter',
                'addDefaultValue'
            ]),
            setFilter () {
                let filter = {
                    name: this.fieldName,
                    value: this.fieldValue
                }

                if (this.type === 'slider') {
                    filter.value = this.options[ this.fieldValue ].id
                }

                this.addFilter(filter)
            },
            switchValueToTitle() {
                let opt = this.options.filter((item) => {
                    return item.id === this.fieldValue
                })

                return opt[0].title || ''
            },
            getFilter: function (name) {
                return this.$store.getters.getFilterValueByName(name)
            }
        }
    }
</script>

<template>
    <section v-if="type === 'select'">
        <b-select
                placeholder="Selecione uma opção"
                size="is-medium"
                v-model="fieldValue"
                @input="setFilter">
            <option
                    v-for="option in options"
                    :value="option.id"
                    :key="option.id">
                {{ option.title }}
            </option>
        </b-select>
    </section>

    <section class="margin-top-10" v-else-if="type === 'switch'">
        <b-switch
                v-model="fieldValue"
                :true-value="switchConfig.trueValue"
                :false-value="switchConfig.falseValue"
                size="is-medium"
                @input="setFilter">
            {{ switchValueToTitle() }}
        </b-switch>
    </section>

    <section v-else-if="type === 'slider'">
        <input
                class="slider is-fullwidth is-medium is-primary is-circle has-output"
                :step="sliderConfig.step"
                :min="sliderConfig.min"
                :max="sliderConfig.max"
                v-model="fieldValue"
                :id="name"
                type="range"
                @input="setFilter">
        <output :for="name">{{ options[ fieldValue ].title }}</output>
    </section>

    <section
            class="margin-top-10"
            v-else-if="type === 'checkbox'">
        <div class="field" v-for="item in options" :key="item.id">
            <b-checkbox
                    v-model="fieldValue"
                    :native-value="item.id"
                    :name="item.slug"
                    size="is-medium"
                    @input="setFilter">{{ item.title }}</b-checkbox>
        </div>
    </section>

    <b-field
            class="margin-top-10"
            v-else-if="type === 'checkbutton'">
        <b-checkbox-button
                v-for="item in options"
                :key="item.id"
                v-model="fieldValue"
                :native-value="item.id"
                type="is-primary"
                @input="setFilter">
            <span>{{ item.value }}</span>
        </b-checkbox-button>
    </b-field>
</template>