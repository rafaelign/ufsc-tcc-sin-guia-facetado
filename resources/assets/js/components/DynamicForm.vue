<script>
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
            this.fieldValue = this.option || this.fieldValue

            if (this.type === 'switch') {
                this.switchConfig.falseValue = this.options[0].id
                this.switchConfig.trueValue = this.options[1].id

                this.fieldValue = this.fieldValue || this.switchConfig.falseValue
            }

            if (this.type === 'slider') {
                this.sliderConfig.min = this.options[0].value
                this.sliderConfig.max = this.options[ this.options.length - 1 ].value

                this.fieldValue = this.fieldValue || 0
            }

            if (this.type === 'checkbox') {
                this.fieldValue = this.fieldValue || []
            }

            if (this.type === 'checkbutton') {
                this.fieldValue = this.fieldValue || []
            }

            if (this.name) {
                this.fieldName = this.name
            }
        },
        methods: {
            setFilter () {
                if (this.type === 'slider') {
                    this.fieldValue = this.options[ this.fieldValue ].id
                }

                this.$emit('setFilter', this.fieldName, this.fieldValue)
            },
            switchValueToTitle() {
                let opt = this.options.filter((item) => {
                    return item.id === this.fieldValue
                })

                return opt[0].title
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