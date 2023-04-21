import { useForm } from '@inertiajs/vue3';

const form = useForm({
    topic_id: null
});


export function updateTopicParent(newParent,child){

    form.topic_id = newParent;
    form.put(route('topic.change.parent', {topic : child}));
}