<template>
    <div class="form-group vueforms-mediafile-input">
        <label>{{caption_text}}</label>
        <div v-if="placeholder_text" class="text-secondary" >{{placeholder_text}}</div>
        <div class="media-preview my-2" >
            <img v-if="current_media" :src="current_media.url" >
        </div>
        <div class="mb-2" >
            <div class="btn btn-secondary btn-sm" @click="selectFile()" >Seleccione un archivo</div>
        </div>
        
        <input 
            type="file" 
            :accept="accept" 
            ref="html_file_input" 
            class="d-none" 
            @change="previewFile"
         >
        <input 
            type="text" 
            :name="input_name"
            v-model="val_input"
            :required="required != '' ? true : false"
            class="d-none"
            
        >
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
            accept:String,
        },
        mounted(){
            let that = this;
            if(this.current_value != ""){
                this.val_input = this.current_value;
                
                fetch('/media_files/'+that.current_value,{
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                })
                .then(response => response.json())
                .then(function(response){
                    that.current_media = response;
                    setTimeout(() => {
                        that.$forceUpdate();    
                    }, 100);
                })
                .catch(err => console.log('Solicitud fállida', err));
            }
        },
        methods:{
           selectFile(){
               this.$refs.html_file_input.click();
           },
           previewFile(){
                if(this.$refs.html_file_input.files.length == 0){return;}
                let that = this;
                let xhr = new XMLHttpRequest();
                let formData = new FormData();
                let mediafile = that.$refs.html_file_input.files[0];      
                
                formData.append("mediafile", mediafile);

                fetch('/media_files',{
                    method: "POST",
                    body: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                })
                .then(response => response.json())
                .then(function(response){
                    if(response != 0){
                        that.current_media = response;
                        that.val_input = that.current_media.id;
                        setTimeout(() => {
                            that.$forceUpdate();    
                        }, 100);
                    }else{
                        that.val_input = "";
                        alert('Error al subir archivo');
                    }
                });
            }
           
        },
        data(){
            return {
                current_media: false,
                val_input: "",
            };
        }
    }
</script>