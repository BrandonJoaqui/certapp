<template>
    <div class="vueforms-textarea">
        <label>
            {{caption_text}}
        </label>
        <div>
            <textarea
                :name="input_name"
                class="form-control" 
                type="text"
                :placeholder="placeholder_text"
                autocomplete="false"
                v-model="current_textarea_value"
                :required="required != '' ? true : false"
            ></textarea>
            <div ref="defaultValContainer" class="d-none" ><slot></slot></div>
        </div>
    </div>
</template>
<script>
     export default {
        props:{
            caption_text:String,
            placeholder_text:String,
            required:String,
            input_name:String,
        },
        mounted(){
            this.current_textarea_value = this.$refs.defaultValContainer.innerHTML
        },
        methods:{
           
        },
        data(){
            return {
                current_textarea_value :"",
            };
        }
    }
</script>