[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/EasyPostTracking/functions?utm_source=RapidAPIGitHub_EasyPostTrackingFunctions&utm_medium=button&utm_content=RapidAPI_GitHub) 
# EasyPostTracking Package
EasyPost is a flexible, modern API that makes it easy to add shipping and tracking to your app. Sign up and start shipping. Thousands of developers already have.
* Domain: easypost.com
* Credentials: apiKey

## How to get credentials: 
1. Register at [EasyPost.com](https://www.easypost.com)
2. Go to your [account page](https://www.easypost.com/account/api-keys) to get your Test and Production keys

## EasyPostTracking.trackPackage
Create a new tracker to track a package, and get it's current transit status.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| The api key obtained from Easy Post.
| trackingCode| String     | The tracking code associated with the package you'd like to track
| carrier     | String     | The carrier associated with the trackingCode you provided. The carrier will get auto-detected if none is provided

## EasyPostTracking.getTrackers
Get all package tracked by the API key.

| Field        | Type       | Description
|--------------|------------|----------
| apiKey       | credentials| The api key obtained from Easy Post.
| trackingCode | String     | Only returns Trackers with the given trackingCode
| carrier      | String     | Only returns Trackers with the given carrier value
| pageSize     | Number     | The number of Trackers to return on each page. The maximum value is 100
| startDatetime| String     | Only return Trackers created after this timestamp. Defaults to 1 month ago, or 1 month before a passed endDatetime. Format: 2016-01-02T00:00:00Z
| endDatetime  | String     | Only return Trackers created after this timestamp. Defaults to 1 month ago, or 1 month before a passed startDatetime. Format: 2016-01-02T00:00:00Z
| beforeId     | String     | Optional pagination parameter. Only trackers created before the given ID will be included. May not be used with afterId. Format: trk_
| afterId      | String     | Optional pagination parameter. Only trackers created after the given ID will be included. May not be used with beforeId. Format: trk_

## EasyPostTracking.getTracker
Get a package tracker by it's ID.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| The api key obtained from Easy Post.
| trackingId| String     | OUnique tracker ID. Format: trk_

