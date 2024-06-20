import {uri} from './uri.js';
export async function fetchEntries() {
    try {
        console.log(uri+'/entry/all');
        return await fetch(uri+'/entry/all', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        }).then((response) => {
            return response.json().then((data) => {
                data.sort((a, b) => {
                    const nameA = a.lastName.toUpperCase();
                    const nameB = b.lastName.toUpperCase();
                    if (nameA < nameB) {
                        return -1;
                    }
                    if (nameA > nameB) {
                        return 1;
                    }
                    return 0;
                });
                return data;
            });
        });
    } catch (error) {
        console.error('Error fetching entries:', error);
    }
}

export async function fetchEntryById(id) {
    try {
        return await fetch(uri+'/entry/id/' + id, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        }).then((response) => {
            return response.json().then((data) => {
                return data;
            });
        });
    } catch (error) {
        console.error('Error fetching entry:', error);
    }
}

export async function fetchDepartments() {
    try {
        return await fetch(uri+'/department/all', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        }).then((response) => {
            return response.json().then((data) => {
                return data;
            });
        });
    } catch (error) {
        console.error('Error fetching departments:', error);
    }
}

export async function fetchDepartmentById(id) {
    try {
        return await fetch(uri+'/department/id/' + id, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        }).then((response) => {
            return response.json().then((data) => {
                return data;
            });
        });
    } catch (error) {
        console.error('Error fetching department:', error);
    }
}