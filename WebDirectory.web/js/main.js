import { renderEntryList, renderDepartmentFilter } from './ui.js';

document.addEventListener('DOMContentLoaded', async () => {
    document.querySelector("#apk-btn").addEventListener("click", async () => {
        //faire télécharger le fichier apk à l'utilisateur qui se trouve à la racine du projet
        window.open('http://127.0.0.1:8080/app-release.apk', '_blank');
    });
    await renderDepartmentFilter();
    await renderEntryList();
});