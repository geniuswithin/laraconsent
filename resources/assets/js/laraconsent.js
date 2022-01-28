import Imports from './imports'
import Helpers from './helpers';

export default class Laraconsent {

    constructor() {
        this._laraConsentInit();
    }

    _laraConsentInit() {
        this.helpers([
            'initCSRF'
        ]);
        console.log('User Consent Initialised');
    }

    init() {
        this._laraConsentInit();
    }

    /*
     * jQuery Class Helpers
     *
     */
    helpers(helpers, options = {}) {
        Helpers.run(helpers, options);
    }

}

// Once everything is loaded
jQuery(() => {
    // Create a new instance of LaraConsent
    window.LaraConsent = new Laraconsent();

});
