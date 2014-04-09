Getting started
===============

Example cms.xml:

```xml

<!-- add this to you menu -->
<item action="alerts"/>

<!-- entity:Alert -->
<action type="list" slug="alerts" entity="FMConanAlertBundle:Alert">
  <action type="view" template="FMConanAlertBundle::alert.html.twig" class="FM\ConanAlertBundle\Action\ViewAlert"/>
  <action type="entity" slug="mute-alert" class="FM\ConanAlertBundle\Action\MuteAlert" title="mute_alert"/>
</action>
<list name="Alerts">
  <dql type="orderBy" sort="e.count" order="desc"/>
  <dql type="orderBy" sort="e.datetimeLastIssued" order="desc"/>
  <filter name="name"/>
  <column name="name" type="choice"/>
  <column name="level"/>
  <column name="message" type="text" truncate="50"/>
  <column name="context" type="json"/>
  <column name="count" badge="true"/>
  <column name="datetime_first_issued"/>
  <column name="datetime_last_issued"/>
  <column name="mute-alert" icon="volume-off" context="warning"/>
</list>
<form name="Alert">
</form>
```
