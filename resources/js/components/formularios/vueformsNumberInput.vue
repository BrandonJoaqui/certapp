<template>
    <div class="form-group vueforms-number-input">
        <label v-if="caption_text" >{{caption_text}}</label>
        <input 
            type="text" 
            class="form-control form-control-sm text-right" 
            v-model="inputValue"
            :name="input_name"
            :placeholder="placeholder_text"
            autocomplete="false"
            :required="required != '' ? true : false"
            @input="emitEventInput"
            @focus="$event.target.select()"
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
                type: Number,
                default: 0
            },
        },
        mounted(){
            if(this.current_value){
                this.inputValue = parseInt(this.current_value);
            }
            if(this.value){
                this.inputValue = parseInt(this.value);
            }
        },
        methods:{
           emitEventInput(){
               if(isNaN(this.inputValue)){
                   this.inputValue = 0;
               }
               this.$emit('input', parseInt(this.inputValue));
           }
        },
        data(){
            return {
                inputValue: 0,
            };
        },
        watch: {
            value : function() {
                this.inputValue = roundNumber(this.value, 2);
            },
        }
    }
</script>