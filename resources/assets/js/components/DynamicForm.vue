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
                this.switchConfig.falseValue = this.options[0].value
                this.switchConfig.trueValue = this.options[1].value

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
                this.$emit('setFilter', this.fieldName, this.fieldValue)
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
                size="is-medium">
            {{ fieldValue }}
        </b-switch>
    </section>

    <input
            v-else-if="type === 'slider'"
            class="slider is-fullwidth is-medium is-primary is-circle"
            :step="sliderConfig.step"
            :min="sliderConfig.min"
            :max="sliderConfig.max"
            v-model="fieldValue"
            type="range">

    <section
            class="margin-top-10"
            v-else-if="type === 'checkbox'">
        <div class="field" v-for="item in options" :key="item.id">
            <b-checkbox
                    v-model="fieldValue"
                    :name="item.slug"
                    :native-value="item.value"
                    size="is-medium">{{ item.title }}</b-checkbox>
        </div>
    </section>

    <b-field
            class="margin-top-10"
            v-else-if="type === 'checkbutton'">
        <b-checkbox-button
                v-for="item in options"
                :key="item.id"
                v-model="fieldValue"
                :native-value="item.value"
                type="is-primary">
            <span>{{ item.value }}</span>
        </b-checkbox-button>
    </b-field>
</template>