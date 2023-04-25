<template>
      <div class="form-check vueforms-check-input">
        <input 
            class="form-check-input" 
            type="checkbox"
            v-model="checkedStatus"
            ref="checkInput"
        >
        <label class="form-check-label noselect" @click="$refs.checkInput.click()" >
            {{caption_text}}{{checkedStatus?" - si":" - no"}}
        </label>
        <input
            :name="input_name"
            type="hidden"
            :value="checkedStatus?1:0"
        >
    </div>
</template>
<script>
     export default {
        props:{
            caption_text:String,
            current_value:String,
            input_name:String,
        },
        mounted(){
            let that = this;
            if(this.current_value){
                
                this.checkedStatus = this.current_value=="1"?true:false;
                console.log(this.current_value);
                console.log(this.checkedStatus);
                setTimeout(() => {
                    that.$forceUpdate();
                }, 150);
            }
        },
        methods:{
            toggleChecked: function(){
                this.checkedStatus = !this.checkedStatus;
            },
        },
        data(){
            return {
                checkedStatus: false
            };
        }
    }
</script>