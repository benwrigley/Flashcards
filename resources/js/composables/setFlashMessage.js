import { usePage } from '@inertiajs/vue3';


export function setFlashMessage(type,message){

    const flashType = type.toLowerCase();
    usePage().props.flash[flashType] = message;
}