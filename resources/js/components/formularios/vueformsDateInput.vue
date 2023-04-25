<template>
    <div class="vueforms-date-input">
        <label v-if="caption_text" >{{caption_text}}</label>
        <input 
            type="date" 
            class="form-control form-control-sm" 
            v-model="inputValue"
            :name="input_name"
            :placeholder="placeholder_text"
            autocomplete="false"
            :required="required == 'required' ? true : false"
            @input="emitEventInput"
        />
    </div>
</template>
<script>
     export default {
        props:{
            caption_text:String,
            current_value:String,
            placeholder_text:String,
            required:String,
            input_name:String,
            value: {
                type: String,
                default: null
            },
        },
        mounted(){
            if(this.current_value){
                this.inputValue = this.current_value;
            }
            if(this.value){
                this.inputValue = this.value;
            }
        },
        methods:{
            emitEventInput(){
               this.$emit('input', this.inputValue);
           }
        },
        data(){
            return {
                inputValue: false,
            };
        }
    }
</script>