import './bootstrap';
import tinymce from 'tinymce';
import 'tinymce/themes/silver';
import 'tinymce/icons/default';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/link';
import 'tinymce/plugins/image';
import 'tinymce/plugins/lists';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';



// Dynamically import the valid module
const loadModule = async () => {
    const module = await import('./someLargeModule'); // Correct path
    module.someFunction(); // Use the function after it's loaded
};

loadModule();