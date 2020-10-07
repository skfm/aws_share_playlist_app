import Vue from 'vue';
import PlaylistTagsInput from './components/PlaylistTagsInput';
import PlaylistStock from './components/PlaylistStock';
import PlaylistUrlCopyButton from './components/PlaylistUrlCopyButton';

const app = new Vue({
    el: '#app',
    components: {
        PlaylistTagsInput,
        PlaylistStock,
        PlaylistUrlCopyButton
    }
});
