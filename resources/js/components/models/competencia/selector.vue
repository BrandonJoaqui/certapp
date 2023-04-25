<template>
    <div class="competencia-selector">
        <label class="form-label" >
            {{caption_text}} 
        </label>

        <div 
            v-if="competenciaValidada" 
            class="text-info text-sm"
        >Actual: 
        {{competenciaValidada.id}} - 
        {{competenciaValidada.descripcion_corta}}
        </div>

        <div class="position-relative">
            <input
                class="form-control" 
                type="text"
                :placeholder="placeholder_text"
                v-model="inputSearch"
                v-on:input="onInputFocus()"
                @click="onInputClick()"
                @blur="hideSearchOptions()"
                autocomplete="off"
                :required="required == 'required' ? true : false"
            >
            <input type="hidden" :name="input_name" v-model="selectedInputId" />
            
            <div
                v-if="search_enabled"
                class="position-absolute bg-white shadow autocomplete-box"
            >
                <ul>
                    <li v-for="competencia in competencias" 
                        @click="SetInputValue(competencia)"
                        @mouseover="lockInputBlur = true"
                        @mouseleave="lockInputBlur = false"
                        class="cursor-pointer hover:bg-blue-200 p-2" 
                    >
                        {{competencia.id}} - 
                        {{competencia.descripcion}}
                    </li>
                </ul>
            </div>
        </div>
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
            value:Object,
        },
        mounted(){
            let that = this;
            if(that.current_value){
                this.seleccionarPorId(that.current_value);
            }
        },
        methods:{
            seleccionarPorId(id){
                this.selectedInputId = id;
                this.validateCurrentValue();
            },
           searchTerm: function(){
                let that = this;
                fetch('/competencias?' 
                + new URLSearchParams({
                    s: that.inputSearch
                }),
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                })
                .then(response => response.json())
                .then(function(jsonResponse){
                    that.competencias = jsonResponse.data;
                })
                .catch(err => console.log('Solicitud fállida', err)); 
            
            },
           onInputClick(){
               this.inputSearch = ""; 
               this.onInputFocus();
           },
           onInputFocus: function(){
               this.search_enabled = true;
               this.lockInputBlur = false;
               this.competenciaValidada = false;
               this.selectedInputId = "";
               this.searchTerm();
           },
           hideSearchOptions: function(){
               if(this.lockInputBlur){return;}
               this.search_enabled = false;
               this.validateCurrentValue();
           },
           SetInputValue: function(empresa){
                this.selectedInputId = empresa.id;
                this.lockInputBlur = false;
                this.search_enabled = false;
                this.validateCurrentValue();
           },
           validateCurrentValue: function(){
                let that = this;
                if(!that.selectedInputId){
                    that.inputSearch = ""; 
                    that.selectedInputId = "";
                    return;
                }

                fetch('/competencias/'+that.selectedInputId,{
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                })
                .then(response => response.json())
                .then(function(response){
                    if(!response){ 
                        that.inputSearch = ""; 
                        that.selectedInputId = "";
                        alert("Seleccione o escriba una competencia válido");
                    }else{
                        that.competenciaValidada = response?response:false;
                        that.inputSearch = that.competenciaValidada.id + " - " 
                                            + that.competenciaValidada.descripcion_corta;
                        if (that.competenciaValidada) {
                            that.$emit('input', that.competenciaValidada);
                        } 
                    }
                })
                .catch(err => console.log('Solicitud fállida', err));
                
           },
        },
        watch: {
            value: {
                deep: true,
                handler(){
                    if(!this.value.id){
                        this.selectedInputId = "";
                        this.competenciaValidada = false;
                        this.validateCurrentValue(); 
                    }
                }
            }
        },
        data(){
            return {
                competencias:[],
                inputSearch:"",
                search_enabled:false,
                lockInputBlur:false,
                competenciaValidada:false,
                selectedInputId:"",
            };
        }
    }
</script>