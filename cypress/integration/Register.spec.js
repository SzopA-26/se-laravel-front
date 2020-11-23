import faker from 'faker';
describe('Registration',() =>{
    const email = 'gomin.p@ku.th'
    const password = '1111111111'
    const confirm = '1111111111'
    it('Success ', function () {
        cy.visit('http://127.0.0.1:8000')
        // cy.get('input[name=name]').type(email)
        // cy.get('input[password=password]').type(password)
        // cy.get('input[password_confirmation=password_confirmation]').type(confirm)
        // cy.get('input[first_name=first_name]').type('Titee')
        // cy.get('input[last_name=last_name]').type('Pawantao')
        // cy.get('button').contains('button').click()
        // cy.url().should('contain','/home')






    });
})

