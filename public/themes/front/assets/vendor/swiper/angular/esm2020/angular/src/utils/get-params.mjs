// @ts-ignore
import Swiper from 'swiper';
import { paramsList } from './params-list';
import { extend, isObject } from './utils';
export const allowedParams = paramsList.map((key) => key.replace(/_/, ''));
export function getParams(obj = {}) {
    const params = {
        on: {},
    };
    // const events = {};
    const passedParams = {};
    extend(params, Swiper.defaults);
    extend(params, Swiper.extendedDefaults);
    params._emitClasses = true;
    params.init = false;
    const rest = {};
    const allowedParams = paramsList.map((key) => key.replace(/_/, ''));
    Object.keys(obj).forEach((key) => {
        const _key = key.replace(/^_/, '');
        if (allowedParams.indexOf(_key) >= 0) {
            if (isObject(obj[key])) {
                params[_key] = {};
                passedParams[_key] = {};
                extend(params[_key], obj[key]);
                extend(passedParams[_key], obj[key]);
            }
            else {
                params[_key] = obj[key];
                passedParams[_key] = obj[key];
            }
        }
        // else if (key.search(/on[A-Z]/) === 0 && typeof obj[key] === 'function') {
        //   events[`${_key[2].toLowerCase()}${key.substr(3)}`] = obj[key];
        // }
        else {
            rest[_key] = obj[key];
        }
    });
    ['navigation', 'pagination', 'scrollbar'].forEach((key) => {
        if (params[key] === true)
            params[key] = {};
        if (params[key] === false)
            delete params[key];
    });
    return { params, passedParams, rest };
}
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiZ2V0LXBhcmFtcy5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzIjpbIi4uLy4uLy4uLy4uLy4uLy4uL3NyYy9hbmd1bGFyL3NyYy91dGlscy9nZXQtcGFyYW1zLnRzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBLGFBQWE7QUFDYixPQUFPLE1BQU0sTUFBTSxRQUFRLENBQUM7QUFDNUIsT0FBTyxFQUFFLFVBQVUsRUFBRSxNQUFNLGVBQWUsQ0FBQztBQUMzQyxPQUFPLEVBQUUsTUFBTSxFQUFFLFFBQVEsRUFBRSxNQUFNLFNBQVMsQ0FBQztBQUUzQyxNQUFNLENBQUMsTUFBTSxhQUFhLEdBQUcsVUFBVSxDQUFDLEdBQUcsQ0FBQyxDQUFDLEdBQUcsRUFBRSxFQUFFLENBQUMsR0FBRyxDQUFDLE9BQU8sQ0FBQyxHQUFHLEVBQUUsRUFBRSxDQUFDLENBQUMsQ0FBQztBQUMzRSxNQUFNLFVBQVUsU0FBUyxDQUFDLE1BQVcsRUFBRTtJQUNyQyxNQUFNLE1BQU0sR0FBUTtRQUNsQixFQUFFLEVBQUUsRUFBRTtLQUNQLENBQUM7SUFDRixxQkFBcUI7SUFDckIsTUFBTSxZQUFZLEdBQWlCLEVBQUUsQ0FBQztJQUN0QyxNQUFNLENBQUMsTUFBTSxFQUFFLE1BQU0sQ0FBQyxRQUFRLENBQUMsQ0FBQztJQUNoQyxNQUFNLENBQUMsTUFBTSxFQUFFLE1BQU0sQ0FBQyxnQkFBZ0IsQ0FBQyxDQUFDO0lBQ3hDLE1BQU0sQ0FBQyxZQUFZLEdBQUcsSUFBSSxDQUFDO0lBQzNCLE1BQU0sQ0FBQyxJQUFJLEdBQUcsS0FBSyxDQUFDO0lBRXBCLE1BQU0sSUFBSSxHQUFpQixFQUFFLENBQUM7SUFDOUIsTUFBTSxhQUFhLEdBQUcsVUFBVSxDQUFDLEdBQUcsQ0FBQyxDQUFDLEdBQUcsRUFBRSxFQUFFLENBQUMsR0FBRyxDQUFDLE9BQU8sQ0FBQyxHQUFHLEVBQUUsRUFBRSxDQUFDLENBQUMsQ0FBQztJQUNwRSxNQUFNLENBQUMsSUFBSSxDQUFDLEdBQUcsQ0FBQyxDQUFDLE9BQU8sQ0FBQyxDQUFDLEdBQVcsRUFBRSxFQUFFO1FBQ3ZDLE1BQU0sSUFBSSxHQUFHLEdBQUcsQ0FBQyxPQUFPLENBQUMsSUFBSSxFQUFFLEVBQUUsQ0FBQyxDQUFDO1FBQ25DLElBQUksYUFBYSxDQUFDLE9BQU8sQ0FBQyxJQUFJLENBQUMsSUFBSSxDQUFDLEVBQUU7WUFDcEMsSUFBSSxRQUFRLENBQUMsR0FBRyxDQUFDLEdBQUcsQ0FBQyxDQUFDLEVBQUU7Z0JBQ3RCLE1BQU0sQ0FBQyxJQUFJLENBQUMsR0FBRyxFQUFFLENBQUM7Z0JBQ2xCLFlBQVksQ0FBQyxJQUFJLENBQUMsR0FBRyxFQUFFLENBQUM7Z0JBQ3hCLE1BQU0sQ0FBQyxNQUFNLENBQUMsSUFBSSxDQUFDLEVBQUUsR0FBRyxDQUFDLEdBQUcsQ0FBQyxDQUFDLENBQUM7Z0JBQy9CLE1BQU0sQ0FBQyxZQUFZLENBQUMsSUFBSSxDQUFDLEVBQUUsR0FBRyxDQUFDLEdBQUcsQ0FBQyxDQUFDLENBQUM7YUFDdEM7aUJBQU07Z0JBQ0wsTUFBTSxDQUFDLElBQUksQ0FBQyxHQUFHLEdBQUcsQ0FBQyxHQUFHLENBQUMsQ0FBQztnQkFDeEIsWUFBWSxDQUFDLElBQUksQ0FBQyxHQUFHLEdBQUcsQ0FBQyxHQUFHLENBQUMsQ0FBQzthQUMvQjtTQUNGO1FBQ0QsNEVBQTRFO1FBQzVFLG1FQUFtRTtRQUNuRSxJQUFJO2FBQ0M7WUFDSCxJQUFJLENBQUMsSUFBSSxDQUFDLEdBQUcsR0FBRyxDQUFDLEdBQUcsQ0FBQyxDQUFDO1NBQ3ZCO0lBQ0gsQ0FBQyxDQUFDLENBQUM7SUFDSCxDQUFDLFlBQVksRUFBRSxZQUFZLEVBQUUsV0FBVyxDQUFDLENBQUMsT0FBTyxDQUFDLENBQUMsR0FBRyxFQUFFLEVBQUU7UUFDeEQsSUFBSSxNQUFNLENBQUMsR0FBRyxDQUFDLEtBQUssSUFBSTtZQUFFLE1BQU0sQ0FBQyxHQUFHLENBQUMsR0FBRyxFQUFFLENBQUM7UUFDM0MsSUFBSSxNQUFNLENBQUMsR0FBRyxDQUFDLEtBQUssS0FBSztZQUFFLE9BQU8sTUFBTSxDQUFDLEdBQUcsQ0FBQyxDQUFDO0lBQ2hELENBQUMsQ0FBQyxDQUFDO0lBRUgsT0FBTyxFQUFFLE1BQU0sRUFBRSxZQUFZLEVBQUUsSUFBSSxFQUFFLENBQUM7QUFDeEMsQ0FBQyIsInNvdXJjZXNDb250ZW50IjpbIi8vIEB0cy1pZ25vcmVcclxuaW1wb3J0IFN3aXBlciBmcm9tICdzd2lwZXInO1xyXG5pbXBvcnQgeyBwYXJhbXNMaXN0IH0gZnJvbSAnLi9wYXJhbXMtbGlzdCc7XHJcbmltcG9ydCB7IGV4dGVuZCwgaXNPYmplY3QgfSBmcm9tICcuL3V0aWxzJztcclxudHlwZSBLZXlWYWx1ZVR5cGUgPSB7IFt4OiBzdHJpbmddOiBhbnkgfTtcclxuZXhwb3J0IGNvbnN0IGFsbG93ZWRQYXJhbXMgPSBwYXJhbXNMaXN0Lm1hcCgoa2V5KSA9PiBrZXkucmVwbGFjZSgvXy8sICcnKSk7XHJcbmV4cG9ydCBmdW5jdGlvbiBnZXRQYXJhbXMob2JqOiBhbnkgPSB7fSkge1xyXG4gIGNvbnN0IHBhcmFtczogYW55ID0ge1xyXG4gICAgb246IHt9LFxyXG4gIH07XHJcbiAgLy8gY29uc3QgZXZlbnRzID0ge307XHJcbiAgY29uc3QgcGFzc2VkUGFyYW1zOiBLZXlWYWx1ZVR5cGUgPSB7fTtcclxuICBleHRlbmQocGFyYW1zLCBTd2lwZXIuZGVmYXVsdHMpO1xyXG4gIGV4dGVuZChwYXJhbXMsIFN3aXBlci5leHRlbmRlZERlZmF1bHRzKTtcclxuICBwYXJhbXMuX2VtaXRDbGFzc2VzID0gdHJ1ZTtcclxuICBwYXJhbXMuaW5pdCA9IGZhbHNlO1xyXG5cclxuICBjb25zdCByZXN0OiBLZXlWYWx1ZVR5cGUgPSB7fTtcclxuICBjb25zdCBhbGxvd2VkUGFyYW1zID0gcGFyYW1zTGlzdC5tYXAoKGtleSkgPT4ga2V5LnJlcGxhY2UoL18vLCAnJykpO1xyXG4gIE9iamVjdC5rZXlzKG9iaikuZm9yRWFjaCgoa2V5OiBzdHJpbmcpID0+IHtcclxuICAgIGNvbnN0IF9rZXkgPSBrZXkucmVwbGFjZSgvXl8vLCAnJyk7XHJcbiAgICBpZiAoYWxsb3dlZFBhcmFtcy5pbmRleE9mKF9rZXkpID49IDApIHtcclxuICAgICAgaWYgKGlzT2JqZWN0KG9ialtrZXldKSkge1xyXG4gICAgICAgIHBhcmFtc1tfa2V5XSA9IHt9O1xyXG4gICAgICAgIHBhc3NlZFBhcmFtc1tfa2V5XSA9IHt9O1xyXG4gICAgICAgIGV4dGVuZChwYXJhbXNbX2tleV0sIG9ialtrZXldKTtcclxuICAgICAgICBleHRlbmQocGFzc2VkUGFyYW1zW19rZXldLCBvYmpba2V5XSk7XHJcbiAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgcGFyYW1zW19rZXldID0gb2JqW2tleV07XHJcbiAgICAgICAgcGFzc2VkUGFyYW1zW19rZXldID0gb2JqW2tleV07XHJcbiAgICAgIH1cclxuICAgIH1cclxuICAgIC8vIGVsc2UgaWYgKGtleS5zZWFyY2goL29uW0EtWl0vKSA9PT0gMCAmJiB0eXBlb2Ygb2JqW2tleV0gPT09ICdmdW5jdGlvbicpIHtcclxuICAgIC8vICAgZXZlbnRzW2Ake19rZXlbMl0udG9Mb3dlckNhc2UoKX0ke2tleS5zdWJzdHIoMyl9YF0gPSBvYmpba2V5XTtcclxuICAgIC8vIH1cclxuICAgIGVsc2Uge1xyXG4gICAgICByZXN0W19rZXldID0gb2JqW2tleV07XHJcbiAgICB9XHJcbiAgfSk7XHJcbiAgWyduYXZpZ2F0aW9uJywgJ3BhZ2luYXRpb24nLCAnc2Nyb2xsYmFyJ10uZm9yRWFjaCgoa2V5KSA9PiB7XHJcbiAgICBpZiAocGFyYW1zW2tleV0gPT09IHRydWUpIHBhcmFtc1trZXldID0ge307XHJcbiAgICBpZiAocGFyYW1zW2tleV0gPT09IGZhbHNlKSBkZWxldGUgcGFyYW1zW2tleV07XHJcbiAgfSk7XHJcblxyXG4gIHJldHVybiB7IHBhcmFtcywgcGFzc2VkUGFyYW1zLCByZXN0IH07XHJcbn1cclxuIl19