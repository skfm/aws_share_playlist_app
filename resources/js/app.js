import Vue from 'vue';
import PlaylistTagsInput from './components/PlaylistTagsInput';
import PlaylistStock from './components/PlaylistStock';

const app = new Vue({
    el: '#app',
    components: {
        PlaylistTagsInput,
        PlaylistStock
    }
});
