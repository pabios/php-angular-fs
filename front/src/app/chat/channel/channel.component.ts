import { Component, OnInit } from '@angular/core';
import {ToastrService} from "ngx-toastr";
import {HttpClient} from "@angular/common/http";
import Pusher from "pusher-js";
import {FormControl, FormGroup} from "@angular/forms";
import {sha512} from "js-sha512";
import {Observable} from "rxjs";
import {chatService} from "../../core/services/chat.service";
import {NotificationService} from "../../core/services/notification.service";
import {AuthService} from "../../core/services/auth.service";

@Component({
  selector: 'app-channel',
  templateUrl: './channel.component.html',
  styleUrls: ['./channel.component.scss']
})
export class ChannelComponent implements OnInit {
  snapForm!: FormGroup;

  messages$!: Observable<any>;

  channel!:any;
  info!: string;
  pusherMessage!: any[];
  discussion!: any[];
  user_id!:any;

  constructor(private toastr: ToastrService,
              private http:HttpClient,
              private chatS: chatService,
              private notif:NotificationService,
              private auth:AuthService) {
    Pusher.logToConsole = true;

    var pusher = new Pusher('2e4bc757da112b198aaf', {
      cluster: 'eu'
    });

    this.channel = pusher.subscribe('pabiosoft');
    this.channel.bind('my-event',  (data:string) => {
      //console.log(data);
      this.info = data;

      this.pusherMessage = [];

      this.pusherMessage.push(data)
      console.log('bonjour le monde ')
      console.log(this.pusherMessage[0][0].content);

      this.discussion = this.pusherMessage[0];

    });

  }

  ngOnInit(): void {
    Pusher.logToConsole = true;
    console.log(this.auth.userId);console.log('**********')

    var pusher = new Pusher('2e4bc757da112b198aaf', {
      cluster: 'eu'
    });

    this.channel = pusher.subscribe('pabiosoft');
    this.channel.bind('my-event',  (data:string) => {
      //console.log(data);
      this.info = data;
    });


    //
    //
    this.messages$ = this.chatS.getAllMessage();
    this.snapForm = new FormGroup({
      content: new FormControl()
    });

    this.user_id = localStorage.getItem('user_id');
  }


  onSend(content:string):void {
    console.log("bonjour texto")
    //this.auth.login();
    // console.log(sha512(password));
    this.chatS.getPusherMessage().subscribe();
    const formData : FormData = new FormData();
    formData.append('content',content)
    formData.append('user_id',this.user_id)
    // formData.append('laDate',laDate)

    this.chatS.addMessage(formData).subscribe(
      (res=>{
        console.log(res)
        if(res == 'error'){
          this.notif.showError("oups","message non envoyer");
        }else{
          this.notif.showSuccess("cool","votre message est partie");
          //this.router.navigateByUrl('/facesnaps');
        }
      })
    )

  }

}
