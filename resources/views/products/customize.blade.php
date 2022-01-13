

@section('content') 
		<section>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>	
			<script type="text/javascript" src="{{asset('js/2d-modules/fabric.js')}}"></script>
			<link rel="preconnect" href="https://fonts.googleapis.com">
				<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
				<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,500;0,900;1,700&display=swap"
				rel="stylesheet">
			
			<link type="text/css" rel="stylesheet" href="{{asset('css/2d-styles/jquery.miniColors.css')}}" />
			<link href="{{asset('css/2d-styles/bootstrap.min.css')}}" rel="stylesheet">
			<link href="{{asset('css/2d-styles/bootstrap-responsive.min.css')}}" rel="stylesheet">
			<style type="text/css">
				.nav-container-class > a{
					text-decoration: none;
				}

				.nav-container-class > a.border-indigo-100:hover{
					color: white;
				}

				.rounded-full.w-10.h-10.mx-4.border-4.border-custom-violet{ 
					border: medium solid rgba(71, 12, 175, 1);
				}

				.color-preview {
					border: 1px solid #CCC;
					margin: 2px;
					zoom: 1;
					vertical-align: top;
					display: inline-block;
					cursor: pointer;
					overflow: hidden;
					width: 20px;
					height: 20px;
				}

				.rotate {  
					-webkit-transform:rotate(90deg);
					-moz-transform:rotate(90deg);
					-o-transform:rotate(90deg);
					-ms-transform:rotate(90deg);		   
				}		

				.Arial{font-family:"Arial";}
				.Helvetica{font-family:"Helvetica";}
				.MyriadPro{font-family:"Myriad Pro";}
				.Delicious{font-family:"Delicious";}
				.Verdana{font-family:"Verdana";}
				.Georgia{font-family:"Georgia";}
				.Courier{font-family:"Courier";}
				.ComicSansMS{font-family:"Comic Sans MS";}
				.Impact{font-family:"Impact";}
				.Monaco{font-family:"Monaco";}
				.Optima{font-family:"Optima";}
				.HoeflerText{font-family:"Hoefler Text";}
				.Plaster{font-family:"Plaster";}
				.Engagement{font-family:"Engagement";}

				.hidden {
					display: none;
				}
				h1, h2, h3, h4 {
					color: rgba(209, 213, 219);
					opacity: 1;
				}

				.img-upload-polaroid{
					padding:4px;background-color:#fff;
					border:1px solid #ccc;
					border:1px solid rgba(0, 0, 0, 0.2);
					-webkit-box-shadow:0 1px 3px rgba(0, 0, 0, 0.1);
					-moz-box-shadow:0 1px 3px rgba(0, 0, 0, 0.1);
					box-shadow:0 1px 3px rgba(0, 0, 0, 0.1);
					}
				.img-polaroid{
					background-color: transparent !important;
					border: none;
					box-shadow: none;
				}
				.sm:flex.sm:items-center.sm:ml-6 {
					display: block !important;
				}

				.border-danger {
					border:1px solid red !important;
				}

				a{
					color: white;
				}
			</style>
		</section> 

		<section style="padding-top: 0 !important;">
		<meta name="csrf-token" content="{{ Session::token() }}"> 
		<!-- Navbar
			================================================== -->
			<input type="hidden" value="{{ Auth::user()->id }}" id="hdn-user-name-id" />
			<div class="container">
				<section id="typography">
				<div class="page-header">
					<h2>Customize Your Own Jersey</h2>
				</div>
				
				<!-- Headings & Paragraph Copy -->
				<div class="row">	
						<div class="custom-design-container">  		
							<div class="span3">
								<div class="tabbable"> <!-- Only required for left/right tabs -->
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab1" data-toggle="tab" style="color:gray">Options</a></li>				    
									<li><a href="#tab2" data-toggle="tab" style="color:gray">Stickers and Logo</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab1">
										<div class="well" style="background-color:#242424;border: 2px solid #242424; box-shadow:0 25px 50px -12px rgba(0, 0, 0, 0.25);">
											<h3>Tee Styles</h3>
											<p style="">
												<select id="tshirttype">                        
													<option value="{{asset('images/2d-img/jersey3.png')}}" selected="selected">Template 1</option>
													<option value="{{asset('images/2d-img/ALLREDFront.PNG')}}">Template 2</option>                                        
													<option value="{{asset('images/2d-img/Design1front.png')}}">Template 3</option>                    
													<option value="{{asset('images/2d-img/RedFront.png')}}">Template 4</option>
													<option value="{{asset('images/2d-img/lineFront.PNG')}}">Template 5</option>                                        
													<option value="{{asset('images/2d-img/Stripeblack.png')}}">Template 6</option>                    
													<option value="{{asset('images/2d-img/newfd.png')}}">Template 7</option>
													<option value="{{asset('images/2d-img/newtsf.png')}}">Template 9</option>
													<option value="{{asset('images/2d-img/jacketfront.png')}}">Template 8</option>
												</select>	
											</p>								
										</div>
										<div class="well" style="background-color:#242424;border: 2px solid #242424; box-shadow:0 25px 50px -12px rgba(0, 0, 0, 0.25);">
											<h3>Fabric Type</h3>
											<p>
												<select id="fabrictype">                        
												<option selected="selected">Spandex</option>
												<option >Sublimax</option>                                        
												<option >Neoprene</option>                    
												<option >Sportsmax</option>
												<option >Polidex</option>                                        
												<option >Ribstop</option>                    
												<option >Squarenet</option>
												<option >Latex</option>                                        
												<option >Micro Shiny</option>                    
												<option >1x1 Lining</option>
											</select>	
											</p>								
										</div>
										<div class="well" style="background-color:#242424;border: 2px solid #242424; box-shadow:0 25px 50px -12px rgba(0, 0, 0, 0.25);">
										<h3>Select Color</h3>
											<ul class="nav">
												<li class="color-preview" title="Red" style="background-color:#FF0000;"></li>
												<li class="color-preview" title="Dark Heather" style="background-color:#616161;"></li>
												<li class="color-preview" title="Gray" style="background-color:#f0f0f0;"></li>
												<li class="color-preview" title="Green" style="background-color:#008000;"></li>
												<li class="color-preview" title="Black" style="background-color:#222222;"></li>
												<li class="color-preview" title="Heather Orange" style="background-color:#fc8d74;"></li>
												<li class="color-preview" title="Heather Dark Chocolate" style="background-color:#432d26;"></li>
												<li class="color-preview" title="Salmon" style="background-color:#eead91;"></li>
												<li class="color-preview" title="Chesnut" style="background-color:#806355;"></li>
												<li class="color-preview" title="Yellow" style="background-color:#ffff00;"></li>
												<li class="color-preview" title="Blue" style="background-color:#0000ff;"></li>
												<li class="color-preview" title="Pink" style="background-color:#ffc0cb;"></li>
												<li class="color-preview" title="Purple" style="background-color:#800080;"></li>
												<li class="color-preview" title="Orange" style="background-color:#ffa500;"></li>
												<li class="color-preview" title="Maroon" style="background-color:#800000;"></li>
												<li class="color-preview" title="Navy" style="background-color:#000080;"></li>
												<li class="color-preview" title="Lime" style="background-color:#00FF00;"></li>
												<li class="color-preview" title="Aqua" style="background-color:#00FFFF;"></li>
												<li class="color-preview" title="Rosy pink" style="background-color:#B38481;"></li>
												<li class="color-preview" title="Violet" style="background-color:#9400D3;"></li>
												<li class="color-preview" title="Pastel Violet" style="background-color:#D291BC;"></li>
												<li class="color-preview" title="Rose Gold" style="background-color:#ECC5C0;"></li>
												<li class="color-preview" title="Silver Pink" style="background-color:#C4AEAD;"></li>
												<li class="color-preview" title="Tomato" style="background-color:#FF6347;"></li>

												
											</ul>
										</div>
										<div class="well" style="background-color:#242424;border: 2px solid #242424; box-shadow:0 25px 50px -12px rgba(0, 0, 0, 0.25);">
											<h3>Pre-made Layout</h3>
											<p style="">
												<button class="submit-file-toggle w-full hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white px-4 py-2 bg-custom-violet my-3">
													Submit File
												</button>
											</p>								
										</div>			      
									</div>				   
									<div class="tab-pane" id="tab2">
										<div class="well" style="background-color:#242424;border: 2px solid #242424; box-shadow:0 25px 50px -12px rgba(0, 0, 0, 0.25);">
											<div class="input-append">
											<h3>Add Text Here	</h3>
											<input class="span2" id="text-string" type="text" placeholder="Type here..."><button id="add-text" class="btn" title="Add text"><i class="icon-share-alt"></i></button>
											<hr>
											</div>
											<div class="" id="avatarlist">
												<img style="cursor:pointer;" class="img-polaroid" src="{{asset('images/2d-img/stickers/sticker_1.png')}}">
												<img style="cursor:pointer;" class="img-polaroid" src="{{asset('images/2d-img/stickers/sticker_2.png')}}">
												<img style="cursor:pointer;" class="img-polaroid" src="{{asset('images/2d-img/stickers/sticker_3.png')}}">
												<img style="cursor:pointer;" class="img-polaroid" src="{{asset('images/2d-img/stickers/sticker_4.png')}}">
												<img style="cursor:pointer;" class="img-polaroid" src="{{asset('images/2d-img/stickers/sticker_5.png')}}">
												<img style="cursor:pointer;" class="img-polaroid" src="{{asset('images/2d-img/stickers/sticker_12.png')}}">
												<img style="cursor:pointer;" class="img-polaroid" src="{{asset('images/2d-img/stickers/sticker_6.png')}}">
												<img style="cursor:pointer;" class="img-polaroid" src="{{asset('images/2d-img/stickers/sticker_7.png')}}">
												<img style="cursor:pointer;" class="img-polaroid" src="{{asset('images/2d-img/stickers/sticker_8.png')}}">
												<img style="cursor:pointer;" class="img-polaroid" src="{{asset('images/2d-img/stickers/sticker_9.png')}}">
												<img style="cursor:pointer;" class="img-polaroid" src="{{asset('images/2d-img/stickers/sticker_10.png')}}">
												<img style="cursor:pointer;" class="img-polaroid" src="{{asset('images/2d-img/stickers/sticker_11.png')}}">
												
											
											</div>	
											<div>
												<hr>
												<input type="file" name="fileToUpload" id="file-upload-container-id">
												<input class="btn btn-primary" id="upload-custom-image-id" type="submit" value="Upload Custom Image" name="submit">
											</div>
											
										</div>				      

  
									</div>
									
								</div>
								</div>				
							</div>		
							<div class="span6">		    
									<div align="center" style="min-height: 32px;">
										<div class="clearfix">
											<div class="btn-group inline pull-left" id="texteditor" style="display:none">						  
												<button id="font-family" class="btn dropdown-toggle" data-toggle="dropdown" title="Font Style"><i class="icon-font" style="width:19px;height:19px;"></i></button>		                      
												<ul class="dropdown-menu" role="menu" aria-labelledby="font-family-X">
													<li><a tabindex="-1" href="#" onclick="setFont('Arial');" class="Arial">Arial</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Helvetica');" class="Helvetica">Helvetica</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Myriad Pro');" class="MyriadPro">Myriad Pro</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Delicious');" class="Delicious">Delicious</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Verdana');" class="Verdana">Verdana</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Georgia');" class="Georgia">Georgia</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Courier');" class="Courier">Courier</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Comic Sans MS');" class="ComicSansMS">Comic Sans MS</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Impact');" class="Impact">Impact</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Monaco');" class="Monaco">Monaco</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Optima');" class="Optima">Optima</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Hoefler Text');" class="Hoefler Text">Hoefler Text</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Plaster');" class="Plaster">Plaster</a></li>
													<li><a tabindex="-1" href="#" onclick="setFont('Engagement');" class="Engagement">Engagement</a></li>
												</ul>
												<button id="text-bold" class="btn" data-original-title="Bold"><img src="{{asset('images/2d-img/font_bold.png')}}" height="" width=""></button>
												<button id="text-italic" class="btn" data-original-title="Italic"><img src="{{asset('images/2d-img/font_italic.png')}}" height="" width=""></button>
												<button id="text-strike" class="btn" title="Strike" style=""><img src="{{asset('images/2d-img/font_strikethrough.png')}}" height="" width=""></button>
												<button id="text-underline" class="btn" title="Underline" style=""><img src="{{asset('images/2d-img/font_underline.png')}}"></button>
												<a class="btn" href="#" rel="tooltip" data-placement="top" data-original-title="Font Color"><input type="hidden" id="text-fontcolor" class="color-picker" size="7" value="#000000"></a>
												<a class="btn" href="#" rel="tooltip" data-placement="top" data-original-title="Font Border Color"><input type="hidden" id="text-strokecolor" class="color-picker" size="7" value="#000000"></a>
												<!--- Background <input type="hidden" id="text-bgcolor" class="color-picker" size="7" value="#ffffff"> --->
											</div>							  
											<div class="pull-right" align="" id="imageeditor" style="display:none">
											<div class="btn-group">										      
												<button class="btn" id="bring-to-front" title="Bring to Front"><i class="icon-fast-backward rotate" style="height:19px;"></i></button>
												<button class="btn" id="send-to-back" title="Send to Back"><i class="icon-fast-forward rotate" style="height:19px;"></i></button>
												<!-- <button id="flip" type="button" class="btn" title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button> -->
												<button id="remove-selected" class="btn" title="Delete selected item"><i class="icon-trash" style="height:19px;"></i></button>
											</div>
											</div>			  
										</div>												
									</div>					
								<button id="flipback" type="button" class="btn" title="Rotate View"><i class="icon-retweet" style="height:19px;"></i></button>
									<div id="shirtDiv" class="shirtDiv page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);">
										<img name="tshirtview" id="tshirtFacing" src="{{ asset('images/2d-img/jersey3.png')}}">
										<div id="drawingArea" style="position: absolute;top: 100px;left: 160px;z-index: 10;width: 230px;height: 570px;">					
											<canvas id="tcanvas" width=230 height="570" class="hover" style="-webkit-user-select: none;margin-top:-67px !important;margin-left:-12px !important;"></canvas>
										</div>
									</div>
							</div>
						</div>
						<div class="upload-design-container" hidden>
							<div class="span3">
								<input class="" id="uploaded-preview-image" style='cursor:pointer;' type="file" > Upload here

								<div class="well" style="background-color:#242424;border: 2px solid #242424; box-shadow:0 25px 50px -12px rgba(0, 0, 0, 0.25);">
									<h3>Custom Layout</h3>
									<p style="">
										<button class="submit-file-toggle w-full align-center relative items-center hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white px-4 py-2 bg-custom-violet my-3">
										<svg xmlns="http://www.w3.org/2000/svg" class="absolute left-8 h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" />
										</svg>	
										Back 
										</button>
									</p>								
								</div>
							</div>
							<canvas id="preview-uploaded-files" class="span6"></canvas>
						</div>
						<form id="validate-form-id">
							<div class="span3">
								<div class="well" style="background-color:#242424;border: 2px solid #242424; box-shadow:0 25px 50px -12px rgba(0, 0, 0, 0.25);">
							<h3>Measurement</h3>
							<h4>Jersey</h4>
								<p>
									<table class="table" style="opacity: 1;color: rgba(107, 114, 128);font-weight:600;">
										<tr>
											<td>NECK</td>
											<td align="right"><input min="0" id="neck-id" style="width: 50px;" value="1" type="number" required>/cm</td>
										</tr>
										<tr>
											<td>CHEST</td>
											<td align="right"><input min="0" id="chest-id" style="width: 50px;" placeholder="1" type="number" required>/cm</td>
										</tr>
										<tr>
											<td>STOMACH</td>
											<td align="right"><input min="0" id="stomach-id" style="width: 50px;"  placeholder="1" type="number" required>/cm</td>
										</tr>
										<tr>
											<td>WAIST</td>
											<td align="right"><input min="0" id="waist-id" style="width: 50px;"  placeholder="1" type="number" required>/cm</td>
										</tr>
										<tr>
											<td>HIP</td>
											<td align="right"><input min="0" id="hip-id" style="width: 50px;"  placeholder="1" type="number" required>/cm</td>
										</tr>
											<tr>
											<td>SHIRT LENGTH</td>
											<td align="right"><input min="0" id="shirt-lenght-id" style="width: 50px;"  placeholder="1" type="number" required>/cm</td>
										</tr>
										<tr>
											<td>SHOULDER</td>
											<td align="right"><input min="0" id="should-id" style="width: 50px;"  placeholder="1" type="number" required>/cm</td>
										</tr>
										<tr>
											<td>BICEP</td>
											<td align="right"><input min="0" id="bicep-id" style="width: 50px;"  placeholder="1" type="number" required>/cm</td>
										</tr>


									</table>			
								</p>
							<h4>Jersey Short</h4>
								<p>
									<table class="table" style="opacity: 1;color: rgba(107, 114, 128);font-weight: 600;">
										<tr>
											<td>WAIST</td>
											<td align="right"><input min="0" id="short-waist-id" style="width: 50px;" value="1" type="number" required>/cm</td>
										</tr>
										<tr>
											<td>OUTSEAM</td>
											<td align="right"><input min="0" id="outseam-id" style="width: 50px;" placeholder="1" type="number" required>/cm</td>
										</tr>
										<tr>
											<td>INSEAM</td>
											<td align="right"><input min="0" id="inseam-id" style="width: 50px;"  placeholder="1" type="number" required>/cm</td>
										</tr>
									</table>
								</p>
						</form>
						<button type="button" class="btn btn-large btn-block btn-success" name="save" id="btn-save">SAVE</button>
					</div>		      		       		   
					</div>
				
				</div>
				
				</section>
			</div>
			<div class="modal-background-class hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
				<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
					
					<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

					<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

					<div class="modal-body-class hidden inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
					<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
						<div class="sm:flex sm:items-start">
						<div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
							
							<svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
							</svg>
						</div>
						<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
							<h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
							Customization Seccessful
							</h3>
							<div class="mt-2">
							<p class="text-sm text-gray-500">
								Jersey customization setup was exported to pdf and has been saved. Please wait for the administrator approval.
							</p>
							</div>
						</div>
						</div>
					</div>
					<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
						<button type="button" id="btn-go-back-to-shop-id" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:text-sm">
						GO TO RESERVATIONS
						</button>
					</div>
					</div>
				</div>
			</div>

			<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
			<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
			
			<script src="{{asset('js/2d-modules/tshirt-page-module/tshirt-module.js')}}"></script>
			<script src="{{asset('js/2d-modules/tshirt-page-module/tshirt-view-module.js')}}"></script>
			<script src="{{asset('js/2d-modules/upload-image-module/upload-custom-image-module.js')}}"></script>
			<script src="{{asset('js/2d-modules/upload-image-module/upload-design-module.js')}}"></script>
			<script type="text/javascript" src="{{asset('js/2d-modules/tshirtEditor.js')}}"></script>
			<script type="text/javascript" src="{{asset('js/2d-modules/jquery.miniColors.min.js')}}"></script>
			<script src="{{asset('js/2d-modules/tshirt-page-module/tshirt-save-setup-module.js')}}"></script>
			<script src="{{asset('js/2d-modules/bootstrap.min.js')}}"></script>  
		</section>
		
@stop
