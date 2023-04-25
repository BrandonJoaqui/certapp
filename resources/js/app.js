import './bootstrap';
import { createApp } from 'vue';

function idExist(idToCheck){
    var element =  document.getElementById(idToCheck);
    if (typeof(element) != 'undefined' && element != null)
    {
     return true;
    }
    return false;
}

/* Vue Apps */
const appMainMenuVue = createApp({}); // Main menu App 
const appMainContent = createApp({}); //Main Content App

/*
// Main menu - Vue App
*/

import MainMenuVue from './components/layout/MainMenuVue.vue';
appMainMenuVue.component('main-menu-vue', MainMenuVue);

/*
// Main content - Vue App
*/

/* IMPORTS: Index Table generic components */
import indexTableSimpleSearchbar from './components/indexTable/simpleSearchbar.vue';
import indexTableActionButtons from './components/indexTable/actionButtons.vue';
/* IMPORTS Forms components */
import vueformsTextInput from './components/formularios/vueformsTextInput.vue';
import vueformsSelectorInput from './components/formularios/vueformsSelectorInput.vue';
import vueformsDateInput from './components/formularios/vueformsDateInput.vue';
import vueformsCheckboxInput from './components/formularios/vueformsCheckboxInput.vue';
import vueformsFileInput from './components/formularios/vueformsMediaFileInput.vue';
import saveCancelButtons from './components/formularios/saveCancelButtons.vue';
/* Models Components */
import terceroSelector from './components/models/tercero/selector.vue';
import equipoSelector from './components/models/equipo/selector.vue';
import competenciaSelector from './components/models/competencia/selector.vue';
/* publicApps */
import consultaCertificadoForm from './components/public/consultaCertificadoForm.vue';

/* Index Table generic components */
appMainContent.component('simple-searchbar', indexTableSimpleSearchbar);
appMainContent.component('action-btns', indexTableActionButtons);
/* Forms components*/
appMainContent.component('input-text', vueformsTextInput);
appMainContent.component('input-selector', vueformsSelectorInput);
appMainContent.component('input-date', vueformsDateInput);
appMainContent.component('input-checkbox', vueformsCheckboxInput);
appMainContent.component('input-file', vueformsFileInput);
appMainContent.component('savecancel-btns', saveCancelButtons);

/* Model components */
appMainContent.component('tercero-selector', terceroSelector);
appMainContent.component('equipo-selector', equipoSelector);
appMainContent.component('competencia-selector', competenciaSelector);

/* publicApps */
appMainContent.component('consulta-certificado-form', consultaCertificadoForm);



/* Apps conditional loaders */
if(idExist('main-app')){
    appMainContent.mount('#main-app');
}
if(idExist('app-menu')){
    appMainMenuVue.mount('#app-menu');
}
