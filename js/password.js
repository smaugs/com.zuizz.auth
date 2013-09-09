(function ($) {
    /**
     * @author Veith Zäch
     * @namespace Tc.Module
     * @class Password
     * @extends Tc.Module
     */
    Tc.Module.Password = Tc.Module.extend({

        /**
         * Initializes the Default module.
         *
         * @method init
         * @constructor
         * @param {jQuery} $ctx the jquery context
         * @param {Sandbox} sandbox the sandbox to get the resources from
         * @param {String} modId the unique module id
         */
        init: function ($ctx, sandbox, modId) {
            var self = this;
            // call base constructor
            this._super($ctx, sandbox, modId);
            self.new_password = $('input[name=new]', $ctx);
            self.repeated_password = $('input[name=repeat]', $ctx);
            self.old_password = $('input[name=old]', $ctx);
            self.updateButton = $('button[name=change]', $ctx);

            self.registerListener(sandbox);
        },

        on: function (callback) {
            var $ctx = this.$ctx,
                self = this;
            callback();
        },
        registerListener: function (sandbox) {
            var $ctx = this.$ctx,
                self = this;

            self.new_password.keyup(function () {
                if (self.passwordsAreEqual(self.new_password.val(), self.repeated_password.val())) {
                    self.enableUpdateButton()
                } else {
                    self.disableUpdateButton();
                }
            });
            self.repeated_password.keyup(function () {
                if (self.passwordsAreEqual(self.new_password.val(), self.repeated_password.val())) {
                    self.enableUpdateButton()
                } else {
                    self.disableUpdateButton();
                }
            });
            self.updateButton.click(function () {
                self.updatePasssword()
            });
        },
        disableUpdateButton: function () {
            var $ctx = this.$ctx,
                self = this;
            self.updateButton.attr('disabled', true);
        },
        enableUpdateButton: function () {
            var $ctx = this.$ctx,
                self = this;
            self.updateButton.attr('disabled', false);
        },
        updatePasssword: function () {
            var $ctx = this.$ctx,
                self = this;

            $.ajax({
                url: '/rest/com.zuizz.auth.passwd/',
                type: 'PUT',
                data: {

                    credentials: self.new_password.val(),    //string
                    old_credentials: self.old_password.val()    //string
                },

                statusCode: {
                    202: function (response) {
                        //Password changed, everthing is OK
                        self.updateButton.addClass('btn-success');
                        self.updateButton.removeClass('btn-danger');
                    },
                    422: function (response) {
                        //Password is too short or simple
                        self.updateButton.addClass('btn-danger');
                        self.updateButton.removeClass('btn-success');

                    }
                }
            });

        },
        passwordsAreEqual: function (password, repeat) {
            if (password == repeat) {
                return true;
            } else {
                return false;
            }
        }



    });
})(Tc.$);