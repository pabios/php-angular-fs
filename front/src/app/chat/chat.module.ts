import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ChannelComponent } from './channel/channel.component';
import {ChatRoutingModule} from "./chat.routing.module";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";



@NgModule({
  declarations: [
    ChannelComponent
  ],
  imports: [
    CommonModule,
    ChatRoutingModule,
    ReactiveFormsModule,
    FormsModule
  ],
  exports:[
    ChannelComponent
  ]
})
export class ChatModule { }
