# StaggeredContact

Framing this out really quickly, just because I need to get it down.

> personTable
>> most things will hang off this

> LastContactedTable

> ContactHistoryTable

> scheduleTable
>>hangs from personTable

> MessageSynopsisTable [^1]

> ContactChannelsTable
>>hangs from personTable

> EventListingTable [^2]

- [X] build database tables
- [X] reframe UI slightly
- [X] start cranking out logic
- [ ] make selecting a person to mail things to populate their email when you hit send
- [ ] highlight the person you've selected
- [ ] make the events a multiselect, so you can pick them easily
- [ ] sort your events in reverse order
- [ ] fix the UI to not suck
- [ ] new page for 'journaling'? Like tumblr, if you use tumblr for a person journal? 

## this really only works for one user

If I want this to extend to N users, I need another table 

> personTypeTable

which allows the system to differentiate between "some yutz I'm emailing" and "the yutz who is me"

## about the scope creep

If I actually end up doing the `EventListingTable` I noted above, then it ends up creating a freaking journaling function. Something short, probably, say a few hundred characters, and keeping track of the date the event happened (that's a `column`) and comparing the last time you talked with/wrote to someone to your event list, and you can have a really low effort way to compose messages without losing *too* much detail. 

Additional scope creep, probably hanging off `scheduleTable`, would be an arbitrary classification system defined by the user. 

Possible structure: user defines three levels of contact: casual, family, intimate, and then tags their events. So when someone comes up in rotation, the list of events suggested is filtered by the proper tags. 

Shit, that means I need 

> tagsTable

Unless I populate `tags` in the UI with the contents of both `personTable` and `personTypeTable`, which would do something similar to building an entire tags table, in which case my data structure needs to take....arbitrary values? Nope, that calls for a linking table

> linkPostToPeople

| Id | PostId | PersonId | personTypeId |
| ----------- | ----------- | ----------- | ----------- |
| 1 | 12 | 45 | null |
| 2 | 12 | null | 16 |

There's definitely a more space efficient way to do this, but it's late and I'm tired.

[^1]: this is probably scope creep

[^2]: okay, *this* is already scope creep
