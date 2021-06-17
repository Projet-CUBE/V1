/// <reference types="cypress" />

context('Création d\'un post', () => {
    before(() => {
        cy.visit('http://localhost/cesi/V1-main/webroot/')
    })

    it('Remplissage du text', () => {
        cy.get('#textPost')
    })
})