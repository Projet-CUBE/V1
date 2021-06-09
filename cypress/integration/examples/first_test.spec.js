/// <reference types="cypress" />

context('Remplir et tester l\'inscription', () => {
    before(() => {
        cy.visit('http://localhost/cesi/V1-main/webroot/')
    })

    // https://on.cypress.io/interacting-with-elements

    it('Check Catégorie', () => {
        cy.get('select#categorie').select('Développement personnel').should('have.value', '6')
        cy.get('#inscription').click()
            //cy.get('#pseudo').type('AnissEstSubjugué')
        cy.get('#email').type('aaa@gmail.com')

        cy.get('#password').type('123344')
        cy.get('#password_confirm').type('123344')
        cy.get('#submit-btn').click()
        cy.get('input:invalid').should('have.length', 1)
        cy.get('input:invalid').then((response) => {
            console.log('response:', response)
            console.log('error message:', response[0].form[0].attributes[4].ownerElement.validationMessage)
            Cypress.env('errorMessage', response[0].form[0].attributes[4].ownerElement.validationMessage)
                // 

        })
    })
    it('validationMessage', () => {
        cy.get('#form-validation').within(() => {
            cy.get('#pseudo').invoke('prop', 'validationMessage')
                .should('equal', Cypress.env('errorMessage'))
        })
    })
    it('Fill and submit', () => {
        cy.get('#pseudo').type('AnissEstSubjugué')
        cy.get('#submit-btn').click()
        cy.get('#error-email').should('contain', 'Cet email est déjà utilisé')
    })
})