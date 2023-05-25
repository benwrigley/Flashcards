export function convertColour(oldColour,newPrefix){

    return oldColour.replace("bg-", newPrefix);
}