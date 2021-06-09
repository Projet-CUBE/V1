/// <reference types="cypress" />
import { connexion } from "../../support/commands.js"


const tabTopside = ["Déconnexion", "Favoris", "Categories", "Evènements", "Profil", "Statistique", "Gestion des comptes", "Accueil"]

context('Remplir et tester la connexion', () => {
    before(() => {
        cy.visit('http://localhost/cesi/V1-main/webroot/')
        cy.get('#connexion').click()
    })

    // https://on.cypress.io/interacting-with-elements

    it('Check errors form', () => {
        cy.get('#password').type('123344')
        cy.get('#submit-btn').click()
        cy.get('input:invalid').should('have.length', 1)
        cy.get('input:invalid').then((response) => {
            console.log('response:', response)
            console.log('error message:', response[0].form[0].attributes[4].ownerElement.validationMessage)
            Cypress.env('errorMessage', response[0].form[0].attributes[4].ownerElement.validationMessage)
        })
    })
    it('validationMessage', () => {
        cy.get('#form-validation').within(() => {
            cy.get('#pseudo').invoke('prop', 'validationMessage')
                .should('equal', Cypress.env('errorMessage'))
        })
    })

    it('Fill and submit with no rights\'s user', () => {
        cy.get('#pseudo').type('AnissEstSubjugué')
        cy.get('#submit-btn').click()
        cy.get('#card-header').contains('AnissEstSubjugué')
        tabTopside.forEach((element) => {
            cy.get('#myTopnav').should('not.have.value', element)
        })
    })

    it('Déconnexion et connexion avec un utilisateur ayant tous les droits', () => {

        cy.visit('http://localhost/cesi/V1-main/webroot/index.php?page=deconnexion')
        connexion()
        cy.get('#card-header').contains('ABABABBA')
        tabTopside.forEach((element) => {
            cy.get('#myTopnav').contains(element)
        })
    })
})