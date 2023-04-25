<template>
    <div class="equipo-selector">
        <label class="form-label" >
            {{caption_text}} 
        </label>

        <div 
            v-if="equipoValidado" 
            class="text-info text-sm"
        >Actual: 
            {{equipoValidado.id}} - 
            {{equipoValidado.placa}} 
            {{equipoValidado.serie}} |
            {{equipoValidado.descripcion}}
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
                    <li v-for="equipo in equipos" 
                        @click="SetInputValue(equipo)"
                        @mouseover="lockInputBlur = true"
                        @mouseleave="lockInputBlur = false"
                        class="cursor-pointer hover:bg-blue-200 p-2" 
                    >
                        {{equipo.id}} -  
                        {{equipo.placa}} 
                        {{equipo.serie}} |
                        {{equipo.descripcion}}
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
                fetch('/equipos?' + new URLSearchParams({
                    s: that.inputSearch
                }),{
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                })
                .then(response => response.json())
                .then(function(jsonResponse){
                    that.equipos = jsonResponse.data;
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
               this.equipoValidado = false;
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

                fetch('/equipos/'+that.selectedInputId,{
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                })
                .then(response => response.json())
                .then(function(response){
                    if(!response){ 
                        that.inputSearch = ""; 
                        that.selectedInputId = "";
                        alert("Seleccione o escriba una equipo válido");
                    }else{
                        that.equipoValidado = response?response:false;
                        that.inputSearch = that.equipoValidado.id + " - " 
                                            + that.equipoValidado.placa 
                                            + " " + that.equipoValidado.serie
                                            + " | " + that.equipoValidado.descripcion;
                        if (that.equipoValidado) {
                            that.$emit('input', that.equipoValidado);
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
                        this.equipoValidado = false;
                        this.validateCurrentValue(); 
                    }
                }
            }
        },
        data(){
            return {
                equipos:[],
                inputSearch:"",
                search_enabled:false,
                lockInputBlur:false,
                equipoValidado:false,
                selectedInputId:"",
            };
        }
    }
</script>