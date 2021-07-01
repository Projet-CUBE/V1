/// <reference types="cypress" />
// ***********************************************************
// This example plugins/index.js can be used to load plugins
//
// You can change the location of this file or turn off loading
// the plugins file with the 'pluginsFile' configuration option.
//
// You can read more here:
// https://on.cypress.io/plugins-guide
// ***********************************************************

// This function is called when a project is opened or re-opened (e.g. due to
// the project's config changing)

const sqlServer = require('cypress-sql-server');
const dbConfig = require('../../cypress.json');

module.exports = (on, dbConfig) => {
    tasks = sqlServer.loadDBPlugin(dbConfig.db);
    on('task', tasks);
}