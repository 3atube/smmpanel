<div marginwidth="0" marginheight="0" style="margin:0;padding:0;min-width:100%;background-color:#ebebeb">
<div style="padding:32px 10px;text-align:center;background-color:#ebebeb">
  
    <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;margin:0 auto;max-width:580px;font-size:0!important">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0">
        <tbody>
          <tr>
            <td align="center" valign="top" style="padding:0;text-align:center;padding-bottom:16px;background-color:#45c29d;font-size:0!important">
                
                <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">
                  
                  <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;width:100%;vertical-align:top">
                      <tbody>
                        <tr>
                          <td align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:20px;text-align:center;vertical-align:top;color:#ffffff;font-weight:bold;padding-bottom:0;padding-top:16px"><a href="https://chowordpress.com/" style="display:inline-block;text-decoration:none;font-family:Helvetica,Arial,sans-serif;color:#ffffff" target="_blank"> Chợ Wordpress</a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                </div>
                
            </td>
          </tr>
        </tbody>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0">
        <tbody>
          <tr>
            <td align="center" valign="top" style="padding:0;text-align:center;background-color:#f9f8fb;font-size:0!important">
                
                <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">
                  
                  <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;width:100%;vertical-align:top">
                      <tbody>
                        <tr>
                          <td align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:center;vertical-align:top;color:#888888">
                            <h2 style="font-family:Helvetica,Arial,sans-serif;margin-left:0;margin-right:0;margin-top:16px;margin-bottom:8px;padding:0;font-size:26px;line-height:36px;font-weight:bold;color:#383d42">Thanh toán thành công !</h2>
                            <p style="font-family:Helvetica,Arial,sans-serif;font-size:19px;line-height:27px;margin-top:16px;margin-bottom:16px">Hãy nhấn vào liên kết bên dưới để xem và download các item mà bạn đã mua.</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                </div>
                
            </td>
          </tr>
        </tbody>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0">
        <tbody>
           <?php
                        if(!empty($email)):
                         foreach ($email['list'] as $key => $value) {
                         ?>
          <tr>
            <td align="center" valign="top" style="padding:0 0 16px;text-align:center;background-color:#ffffff;border-top:1px solid;border-color:#ebebeb;font-size:0!important">
                
                <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">
                  
                  <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:190px">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;width:100%;vertical-align:top">
                      <tbody>
                        <tr>
                          <td align="center" valign="top" style="    padding: 16px 16px 0;
    font-family: Helvetica,Arial,sans-serif;
    font-size: 15px;
    text-align: center;
    vertical-align: top;
    color: #888888;
    width: 158px;
    height: 108px;"><a href="{{$value['slug']}}"><img src="{{$value['image']}}" width="158" height="158" alt="" style="    line-height: 1;
    outline: none;
    border: 0;
    text-decoration: none;
    display: block;
    display: block;
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: contain;" class="CToWUd a6T" tabindex="0"></a>
    <div class="a6S" dir="ltr" style="opacity: 0.01; left: 396px; top: 576.813px;"><div id=":1me" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Tải xuống tệp đính kèm " data-tooltip-class="a1V" data-tooltip="Tải xuống"><div class="akn"><div class="aSK J-J5-Ji aYr"></div></div></div></div></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                  <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:390px">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;width:100%;vertical-align:top">
                      <tbody>
                       
                        <tr>
                          <td align="center" valign="top" style="padding:16px 16px 0;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:left;vertical-align:top;color:#888888">
                            <h6 style="font-family:Helvetica,Arial,sans-serif;margin-left:0;margin-right:0;margin-top:0;margin-bottom:8px;padding:0;font-size:16px;line-height:24px;font-weight:bold;color:#383d42"><a href="{{$value['slug']}}">{{$value['title']}}</a></h6>
                           
                            <h1 style="font-family:Helvetica,Arial,sans-serif;margin-left:0;margin-right:0;margin-top:16px;margin-bottom:8px;padding:0;font-size:26px;line-height:36px;font-weight:bold;color:#45c29d">{{$value['price']}} đ<small style="font-size:86%;font-weight:normal"></small></h1>
                          </td>
                        </tr>
                       
                      </tbody>
                    </table>
                  </div>
                  
                </div>
                
            </td>
          </tr>
           <?php   # code...
                        } endif;?>
        </tbody>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0">
        <tbody>
          <tr>
            <td align="center" valign="top" style="padding:0;text-align:center;background-color:#f9f8fb;font-size:0!important">
                
                <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">
                  
                  <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;width:100%;vertical-align:top">
                      <tbody>
                        <tr>
                          <td align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:center;vertical-align:top;color:#888888">
                            <table align="center" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;clear:both;margin:0 auto">
                              <tbody>
                                <tr>
                                  <td style="padding:12px 24px;font-family:Helvetica,Arial,sans-serif;font-size:16px;text-align:center;vertical-align:middle;background-color:#ed7e2c"><a href="https://chowordpress.com/customer/my-orders" style="display:block;text-decoration:none;font-family:Helvetica,Arial,sans-serif;color:#ffffff;font-weight:bold;text-align:center" target="_blank">Xem item đã mua</span></a></td>
                                </tr>
                              </tbody>
                            </table>
                           <table width="80" border="0" align="center" cellpadding="0" cellspacing="0" style="border-spacing:0;width:48px;margin-left:auto;margin-right:auto;clear:both">
                              <tbody>
                                <tr>
                                  <td style="padding:0;font-size:0;height:8px;overflow:hidden">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td style="padding:0;font-size:0;height:8px;overflow:hidden">&nbsp;</td>
                                </tr>
                              </tbody>
                            </table>

                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                </div>
                
            </td>
          </tr>
        </tbody>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0">
        <tbody>
          <tr>
            <td align="center" valign="top" style="padding:0;text-align:center;padding-bottom:16px;background-color:#f9f8fb;border-top:1px solid;border-color:#ebebeb;font-size:0!important">
                
                <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">
                  
                  <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:390px">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;width:100%;vertical-align:top">
                      <tbody>
                        <tr>
                          <td align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:left;vertical-align:top;color:#b3b3b5;padding-bottom:0;padding-top:16px">
                          <strong>Chợ Wordpress</strong><br>
                          <small style="font-size:86%;font-weight:normal"><a href="mailto:chowordpress@gmail.com" style="display:inline-block;text-decoration:none;font-family:Helvetica,Arial,sans-serif;color:#7a7a7a" target="_blank">chowordpress@gmail.com</a>. <br>
                          </small></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                  <div style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:190px">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;width:100%;vertical-align:top">
                      <tbody>
                        <tr>
                          <td align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:right;vertical-align:top;color:#b3b3b5;padding-bottom:0;padding-top:16px">
                            <a href="https://www.facebook.com/groups/chowordpress" style="display:inline-block;text-decoration:none;font-family:Helvetica,Arial,sans-serif;color:#7a7a7a" target="_blank">&nbsp;<img src="https://chowordpress.com/img/icon-logo-facebook.png" height="24" alt="" style="line-height:1;outline:none;border:0;text-decoration:none" class="CToWUd">&nbsp;</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                </div>
                
            </td>
          </tr>
        </tbody>
      </table><div class="yj6qo"></div><div class="adL">
    </div></div><div class="adL">
   
</div></div><div class="adL"> 
</div></div>