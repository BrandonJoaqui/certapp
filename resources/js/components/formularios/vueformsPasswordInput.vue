<template>
    <div class="form-group vueforms-password-input">
        <label v-if="caption_text" >{{caption_text}}</label>
        <input 
            type="password" 
            class="form-control form-control-sm"
            v-model="inputValue" 
            :name="input_name"
            :placeholder="placeholder_text"
            autocomplete="false"
            :required="required != '' ? true : false"
            @input="emitEventInput"
        >
    </div>
</template>
<script>
     export default {
        props:{
            caption_text:String,
            current_value:String,
            placeholder_text:String,
            required: {
                type: String,
                default: ""
            },
            input_name: {
                type: String,
                default: ""
            },
            value: {
                type: String,
                default: ""
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
                inputValue: "",
            };
        }
    }
</script>