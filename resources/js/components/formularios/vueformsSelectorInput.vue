<template>
    <div class="form-group vueforms-selector-input">
        <label>{{caption_text}}</label>
        <select 
            type="text" 
            class="form-control form-control-sm " 
            :name="input_name"
            :placeholder="placeholder_text"
            v-model="val_input"
            :required="required != '' ? true : false"
        >
            <option 
                v-for="val in input_values" 
            >{{val}}</option>
        </select>
    </div>
</template>
<script>
     export default {
        props:{
            caption_text:String,
            current_value:String,
            input_values:Array,
            placeholder_text:String,
            required:String,
            input_name:String,
        },
        mounted(){
            if(this.current_value != ""){
                this.val_input = this.current_value;
            }
        },
        methods:{
           
        },
        data(){
            return {
                val_input:"",
            };
        }
    }
</script>