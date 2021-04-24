<template>
    <div>
        <input  required :id="inputId" type="text" class="w-full phone-inp form-control" placeholder="712345678">
        <input  style="display:none" :value="real_number"  :name="name">
        <span class="text-danger" :id="'error-msg'+inputId"></span>
        <span class="text-danger" :id="'valid-msg'+inputId"></span>
    </div>
</template>
<script>
import axios from "axios";
    export default {
        name: "phone-input",
        props:{
            name:{
                type:String,
                required:true,
            },
            inputId:{
                type:String,
                required:true,
            },
            value:{
                type: String,
                required:false,
            }        
        },
        
        data() {
            return {
                real_number:'',
                iti_ref:null,
            }
        },
        mounted() {
            var app = this;
            new Promise(function(resolve,reject){
                app.phoneInput();
                resolve();
            }).then(()=>{
                if(app.value !='' && app.value != null){
                    app.setInitialNumber(app.value);
                }
            })
        },
        methods: {
            phoneInput(){
                var app =this;
                var input = document.querySelector("#"+this.inputId),
                    errorMsg = document.querySelector("#error-msg"+this.inputId),
                    validMsg = document.querySelector("#valid-msg"+this.inputId);
                    // here, the index maps to the error code returned from getValidationError - see readme
                var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
                
                var iti = intlTelInput(input,({
                    utilsScript:'https://intl-tel-input.com/node_modules/intl-tel-input/build/js/utils.js?<%= time %>',
                    // options here
                    autoHideDialCode: true,
                    autoPlaceholder: true,
                  
                    geoIpLookup: function (callback) {
                        $.get("https://ipinfo.io", function () {
                        }, "jsonp").always(function (resp) {
                            let countryCode = (resp && resp.country) ? resp.country : "";
                            callback(countryCode);
                        });
                    },
                    customPlaceholder: function (selectedCountryPlaceholder, selectedCountryData) {
                        return "e.g. " + selectedCountryPlaceholder;
                    },
                    initialCountry: "ug",
                    nationalMode: true,
                    numberType: "MOBILE",
                   
                    preferredCountries: ['ug', 'ke', 'tz', 'rw'],
                }))
                var reset = function() {
                    input.classList.remove("error");
                    errorMsg.innerHTML = "";
                    errorMsg.classList.add("hide");
                    validMsg.classList.add("hide");
                };

                // on blur: validate
                input.addEventListener('blur', function() {
                    reset();
                    if (input.value.trim()) {
                        if (iti.isValidNumber()) {
                        validMsg.classList.remove("hide");
                        } else {
                            input.classList.add("error");
                            var errorCode = iti.getValidationError();
                            errorMsg.innerHTML = errorMap[errorCode];
                            errorMsg.classList.remove("hide");
                        }
                    }
                });

                // on keyup / change flag: reset
                input.addEventListener('change', reset);
                input.addEventListener('keyup', reset);


                input.addEventListener("keyup", function() { app.setNumber(iti);});
                input.addEventListener("countrychange", function() {app.setNumber(iti);});
                input.addEventListener("change", function() {app.setNumber(iti);});
                
                this.iti_ref = iti;
            },   
            setNumber(iti){
                this.real_number = iti.getNumber();
            },
            
            setInitialNumber(number){
                this.iti_ref.setNumber(number);
                this.real_number = number;    
            },

            phoneNumberEntered(){
                console.log(this.real_number)
            }
        },

          watch: {
            // whenever question changes, this function will run
            real_number: function (oldVal, newVal) {
                // this.debouncedGetAnswer()
                this.$emit('phone-number-changed', this.real_number,this.inputId);
            }
        },
    }
</script>
