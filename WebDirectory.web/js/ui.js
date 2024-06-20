import { fetchEntries, fetchEntryById, fetchDepartments, fetchDepartmentById } from './api.js';
import {uri} from './uri.js';

let isSortedInAlphabeticalOrder = false;

export async function renderEntryList() {
    const entries = await fetchEntries()
    for (let entry of entries) {
        entry.department = await fetchDepartmentById(entry.department);
    }
    const source = document.getElementById('entry-list-template').innerHTML;
    const template = Handlebars.compile(source);
    const context = { entries };
    const html = template(context);
    document.getElementById('entry-list').innerHTML = html;

    document.querySelectorAll('.entry-link').forEach(link => {
        link.addEventListener('click', event => {
            event.preventDefault();
            const id = event.target.dataset.id;
            renderEntryDetail(id);
        });
    });
    document.getElementById('entry-detail').style.display = 'none';
}

export async function renderEntryDetail(id) {
    let entry = await fetchEntryById(id);
    entry.department = await fetchDepartmentById(entry.department);
    entry.pp = uri + '/files/' + entry.pp;
    const source = document.getElementById('entry-detail-template').innerHTML;
    const template = Handlebars.compile(source);
    const context = entry;
    const html = template(context);
    document.getElementById('entry-detail').innerHTML = html;
    document.getElementById('entry-detail').style.display = 'flex';
    document.getElementById('back-button').addEventListener('click', event => {
        event.preventDefault();
        document.getElementById('entry-detail').style.display = 'none';
    });
}

const searchInput = document.getElementById('search');
searchInput.addEventListener('input', filterEntries);

function filterEntries() {
    const filterValue = searchInput.value.toUpperCase();
    const department = document.getElementById('department-filter').value;
    const entries = document.querySelectorAll('.entry-link');
    entries.forEach(entry => {
        const entryName = entry.textContent.toUpperCase();
        if (entryName.includes(filterValue) && (department === 'All' || entry.dataset.department.id === department.id)) {
            entry.style.display = 'flex';
        } else {
            entry.style.display = 'none';
        }
    });
}

export async function renderDepartmentFilter() {
    const departments = await fetchDepartments();
    const selectElement = document.getElementById('department-filter');
    departments.forEach(department => {
        const optionElement = document.createElement('option');
        optionElement.value = department.id;
        optionElement.textContent = department.name;
        selectElement.appendChild(optionElement);
    });
    selectElement.addEventListener('change', filterEntriesByDepartment);
}

function filterEntriesByDepartment() {
    const filterValue = searchInput.value.toUpperCase();
    const department = document.getElementById('department-filter').value;
    const entries = document.querySelectorAll('.entry-link');
    entries.forEach(entry => {
        const entryName = entry.textContent.toUpperCase();
        if (entryName.includes(filterValue) && (department === 'All' || entry.dataset.department == department)) {
            entry.style.display = 'flex';
        } else {
            entry.style.display = 'none';
        }
    });
}
function sortEntries() {
    const entries = Array.from(document.querySelectorAll('.entry-link'));
    entries.sort((a, b) => {
        const nameA = a.textContent.toUpperCase();
        const nameB = b.textContent.toUpperCase();
        if (nameA < nameB) {
            return isSortedInAlphabeticalOrder ? -1 : 1;
        }
        if (nameA > nameB) {
            return isSortedInAlphabeticalOrder ? 1 : -1;
        }
        return 0;
    });
    const entryList = document.getElementById('entry-list');
    const ul = document.createElement('ul');
    entries.forEach(entry => ul.appendChild(entry));
    entryList.appendChild(ul);
    isSortedInAlphabeticalOrder = !isSortedInAlphabeticalOrder;
}
const alphabeticButton = document.getElementById('alphabetic-button');
alphabeticButton.addEventListener('click', sortEntries);