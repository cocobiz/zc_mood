<div class="step-title fix">
	<span class="number l"><?php echo ++$_step?></span>
	<h2 class="l">Shipping Information</h2>
</div>
<div class="step">
	<form id="co-shipping-form" action="">
		<ul class="form-list">
			<li id="shipping-new-address-form">
					<input type="hidden" id="shipping:address_id" value="" name="shipping[address_id]">
					<ul>
						<li class="fields fix">
							<div class="customer-name">
								<div class="field name-firstname">
									<label class="required" for="shipping:firstname">
										First Name
										<em>*</em>
									</label>
									<div class="input-box">
										<input type="text" onchange="shipping.setSameAsBilling(false)" class="input-text required-entry" maxlength="255" title="First Name" value="" name="shipping[firstname]" id="shipping:firstname">
									</div>
								</div>
								<div class="field name-lastname">
									<label class="required" for="shipping:lastname">
										Last Name
										<em>*</em>
									</label>
									<div class="input-box">
										<input type="text" onchange="shipping.setSameAsBilling(false)" class="input-text required-entry" maxlength="255" title="Last Name" value="" name="shipping[lastname]" id="shipping:lastname">
									</div>
								</div>
							</div>
						</li>
						<li class="fields fix">
							<div class="wide">
								<label for="shipping:company">Company</label>
								<div class="input-box">
									<input type="text" onchange="shipping.setSameAsBilling(false);" class="input-text " title="Company" value="" name="shipping[company]" id="shipping:company">
								</div>
							</div>
						</li>
						<li class="wide fix">
							<label class="required" for="shipping:street1">
								Address
								<em>*</em>
							</label>
							<div class="input-box">
								<input type="text" onchange="shipping.setSameAsBilling(false);" class="input-text  required-entry" value="" id="shipping:street1" name="shipping[street][]" title="Street Address">
							</div>
						</li>
						<li class="wide fix">
							<div class="input-box">
								<input type="text" onchange="shipping.setSameAsBilling(false);" class="input-text " value="" id="shipping:street2" name="shipping[street][]" title="Street Address 2">
							</div>
						</li>
						<li class="fields fix">
							<div class="field">
								<label class="required" for="shipping:city">
									City
									<em>*</em>
								</label>
								<div class="input-box">
									<input type="text" onchange="shipping.setSameAsBilling(false);" id="shipping:city" class="input-text  required-entry" value="" name="shipping[city]" title="City">
								</div>
							</div>
							<div class="field">
								<label class="required" for="shipping:region">
									State/Province
									<em>*</em>
								</label>
								<div class="input-box">
									
									<select style="top: 0px; left: 0px;" class="validate-select required-entry b-core-ui-select__select_state_hide" title="State/Province" name="shipping[region_id]" id="shipping:region_id" defaultvalue="">
										<option value="" selected="selected">Please select region, state or province</option>
										
									</select>
									
									<input type="text" style="display: none;" class="input-text required-entry" title="State/Province" value="" name="shipping[region]" id="shipping:region">
								</div>
							</div>
						</li>
						<li class="fields fix">
							<div class="field">
								<label class="required" for="shipping:postcode">
									<em>*</em>
									Zip/Postal Code
								</label>
								<div class="input-box">
									<input type="text" onchange="shipping.setSameAsBilling(false);" class="input-text validate-zip-international  required-entry" value="" id="shipping:postcode" name="shipping[postcode]" title="Zip/Postal Code">
								</div>
							</div>
							<div class="field">
								<label class="required" for="shipping:country_id">
									<em>*</em>
									Country
								</label>
								<div class="input-box">
									<select onchange="if(window.shipping)shipping.setSameAsBilling(false);" title="Country" class="validate-select" id="shipping:country_id" name="shipping[country_id]">
										<option value=""></option>
										
									</select>
								</div>
							</div>
						</li>
						<li class="fields fix">
							<div class="field">
								<label class="required" for="shipping:telephone">
									<em>*</em>
									Telephone
								</label>
								<div class="input-box">
									<input type="text" onchange="shipping.setSameAsBilling(false);" id="shipping:telephone" class="input-text  required-entry" title="Telephone" value="" name="shipping[telephone]">
								</div>
							</div>
							<div class="field">
								<label for="shipping:fax">Fax</label>
								<div class="input-box">
									<input type="text" onchange="shipping.setSameAsBilling(false);" id="shipping:fax" class="input-text " title="Fax" value="" name="shipping[fax]">
								</div>
							</div>
						</li>
						<li class="no-display">
							<input type="hidden" value="1" name="shipping[save_in_address_book]">
						</li>
					</ul>
			</li>
			<li class="control">
				<span class="checkbox"></span>
				<input type="checkbox" class="checkbox" onclick="shipping.setSameAsBilling(this.checked)" title="Use Billing Address" value="1" id="shipping:same_as_billing" name="shipping[same_as_billing]" style="left: -10000px; opacity: 0; position: absolute; z-index: -1;">
				<label for="shipping:same_as_billing">Use Billing Address</label>
			</li>
		</ul>
		<div id="shipping-buttons-container" class="buttons-set fix">
			<button class="submit l">Continue</button>
			<p class="required l">* Required Fields</p>
			<span style="display: none;" class="please-wait" id="shipping-please-wait">
				<img class="v-middle" title="Loading next step..." alt="Loading next step..." src="">
				Loading next step...
			</span>
		</div>
		<p class="back-link">
				<a onclick="checkout.back(); return false;" href="#">
					<small>« </small>
					Back
				</a>
			</p>
	</form>
</div>