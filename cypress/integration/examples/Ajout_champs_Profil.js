/// <reference types="cypress" />

context('Remplir et tester l\'inscription', () => {
    before(() => {
        cy.visit('http://localhost/cesi/V1-main/webroot/')
    })

    // https://on.cypress.io/interacting-with-elements

    it('Check Catégorie', () => {
        cy.get('#connexion').click()
        cy.get('#pseudo').type('All')

        cy.get('#password').type('1234')
        cy.get('.btn').click()

        // Page Profil
        cy.get('#profil').click()

        cy.get('#prenom').type('CyPrenom')
        cy.get('#nom').type('CyNom')
        cy.get('#pseudo').type('CyUsername')
        cy.get('#email').type('TestCy@gmail.com')
        cy.get('#password').type('1234')
        cy.get('.btn').click()
    })
    // it('validationMessage', () => {
    //     cy.get('#form-validation').within(() => {
    //         cy.get('#pseudo').invoke('prop', 'validationMessage')
    //             .should('equal', Cypress.env('errorMessage'))
    //     })
    // })
    // it('Fill and submit', () => {
    //     cy.get('#pseudo').type('All')
    //     cy.get('#submit-btn').click()
    //     cy.get('#error-email').should('contain', 'Cet email est déjà utilisé')
    // })
})